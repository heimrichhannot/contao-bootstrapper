<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package bootstrapper
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;


class BootstrapperFormTextArea extends BootstrapperFormField
{
    protected $strTemplate = 'bootstrapper_form_textarea';

    protected function compile()
    {
        if ($this->objWidget->rte == 'tinyMCE') {
            $this->Template->tinyMCE = true;
            $this->addCssClass($this->objWidget->rte);

            $this->Template->toolbar    = $this->getSetting('toolbar');
            $this->Template->contentCss = $this->getSetting('content_css');
        }
    }
}