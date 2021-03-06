<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2014 Heimrich & Hannot GmbH
 * @package ajaxcontent
 * @author Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\AjaxContent;

class ModuleAjaxSubscribe extends \ModuleSubscribe
{

    /**
     * Add a new recipient
     */
    protected function addRecipient()
    {
        if (!\Environment::get('isAjaxRequest')) {
            return parent::addRecipient();
        }

        $arrChannels = \Input::post('channels');

        if (!is_array($arrChannels)) {
            $_SESSION['UNSUBSCRIBE_ERROR'] = $GLOBALS['TL_LANG']['ERR']['noChannels'];
            return false;
        }

        $arrChannels = array_intersect($arrChannels, $this->nl_channels); // see #3240

        // Check the selection
        if (!is_array($arrChannels) || empty($arrChannels)) {
            $_SESSION['SUBSCRIBE_ERROR'] = $GLOBALS['TL_LANG']['ERR']['noChannels'];
            return false;
        }

        $varInput = \Idna::encodeEmail(\Input::post('email', true));

        // Validate the e-mail address
        if (!\Validator::isEmail($varInput)) {
            $_SESSION['SUBSCRIBE_ERROR'] = $GLOBALS['TL_LANG']['ERR']['email'];
            return false;
        }

        $arrSubscriptions = [];

        // Get the existing active subscriptions
        if (($objSubscription = \NewsletterRecipientsModel::findBy(["email=? AND active=1"], $varInput)) !== null) {
            $arrSubscriptions = $objSubscription->fetchEach('pid');
        }

        $arrNew = array_diff($arrChannels, $arrSubscriptions);

        // Return if there are no new subscriptions
        if (!is_array($arrNew) || empty($arrNew)) {
            $_SESSION['SUBSCRIBE_ERROR'] = $GLOBALS['TL_LANG']['ERR']['subscribed'];
            return false;
        }

        // Remove old subscriptions that have not been activated yet
        if (($objOld = \NewsletterRecipientsModel::findBy(["email=? AND active=''"], $varInput)) !== null) {
            while ($objOld->next()) {
                $objOld->delete();
            }
        }

        $time     = time();
        $strToken = md5(uniqid(mt_rand(), true));

        // Add the new subscriptions
        foreach ($arrNew as $id) {
            $objRecipient = new \NewsletterRecipientsModel();

            $objRecipient->pid       = $id;
            $objRecipient->tstamp    = $time;
            $objRecipient->email     = $varInput;
            $objRecipient->active    = '';
            $objRecipient->addedOn   = $time;
            $objRecipient->ip        = $this->anonymizeIp(\Environment::get('ip'));
            $objRecipient->token     = $strToken;
            $objRecipient->confirmed = '';

            $objRecipient->save();
        }

        // Get the channels
        $objChannel = \NewsletterChannelModel::findByIds($arrChannels);

        // Prepare the e-mail text
        $strText = str_replace('##token##', $strToken, $this->nl_subscribe);
        $strText = str_replace('##domain##', \Idna::decode(\Environment::get('host')), $strText);
        $strText = str_replace('##link##', \Idna::decode(\Environment::get('base')) . \Environment::get('request') . ((\Config::get('disableAlias') || strpos(\Environment::get('request'), '?') !== false) ? '&' : '?') . 'token=' . $strToken, $strText);
        $strText = str_replace(['##channel##', '##channels##'], implode("\n", $objChannel->fetchEach('title')), $strText);

        // Activation e-mail
        $objEmail           = new \Email();
        $objEmail->from     = $GLOBALS['TL_ADMIN_EMAIL'];
        $objEmail->fromName = $GLOBALS['TL_ADMIN_NAME'];
        $objEmail->subject  = sprintf($GLOBALS['TL_LANG']['MSC']['nl_subject'], \Idna::decode(\Environment::get('host')));
        $objEmail->text     = $strText;
        $objEmail->sendTo($varInput);

        // Redirect to the jumpTo page
        if ($this->jumpTo && ($objTarget = $this->objModel->getRelated('jumpTo')) !== null) {
            $this->redirect($this->generateFrontendUrl($objTarget->row()));
        }

        $_SESSION['SUBSCRIBE_CONFIRM'] = $GLOBALS['TL_LANG']['MSC']['nl_confirm'];
        return true;
    }
} 