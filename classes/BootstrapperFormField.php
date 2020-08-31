<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package anwaltverein
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;

define('BOOTSTRAPPER_FORM_GROUP_CLASS', 'form-group');
define('BOOTSTRAPPER_ERROR_CLASS', 'has-error');

define('BOOTSTRAPPER_OPTION_HIDELABEL', 'hideLabel');
define('BOOTSTRAPPER_OPTION_SHOWGROUPLABEL', 'showGroupLabel');
define('BOOTSTRAPPER_OPTION_EXPLANATION', 'explanation');
define('BOOTSTRAPPER_OPTION_INVISIBLE', 'invisible');
define('BOOTSTRAPPER_OPTION_CHANGEFILE', 'changeFile');
define('BOOTSTRAPPER_OPTION_REMOVEFILE', 'removeFile');
define('BOOTSTRAPPER_OPTION_FILEICONCLASS', 'fileIconClass');
define('BOOTSTRAPPER_OPTION_SINGLESELECT', 'singleSelect');
define('BOOTSTRAPPER_OPTION_SHOWDESCRIPTION', 'showDescription');
define('BOOTSTRAPPER_OPTION_INLINE', 'inline');
define('BOOTSTRAPPER_OPTION_TOOLBAR', 'toolbar');
define('BOOTSTRAPPER_OPTION_CONTENTCSS', 'content_css');
define('BOOTSTRAPPER_OPTION_DISABLEOPTGROUPS', 'disableOptGroups');
define('BOOTSTRAPPER_OPTION_LINKED_START', 'linkedStart');
define('BOOTSTRAPPER_OPTION_LINKED_END', 'linkedEnd');
define('BOOTSTRAPPER_OPTION_MIN_DATE', 'minDate');
define('BOOTSTRAPPER_OPTION_MAX_DATE', 'maxDate');
define('BOOTSTRAPPER_OPTION_MINUTE_STEPS', 'minuteSteps');

abstract class BootstrapperFormField extends \Widget
{

    /**
     * Widget
     *
     * @var \Widget
     */
    protected $objWidget;

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate;

    /**
     * Current object data
     *
     * @var array
     */
    protected $arrData = [];

    /**
     * Css classes
     *
     * @var array
     */
    protected $arrCssClasses = [];

    /**
     * Css classes for form-group
     *
     * @var array
     */
    protected $arrGroupCssClasses = [];


    /**
     * The dca config of the field
     *
     * @var array
     */
    protected $arrDca = [];

    /**
     * Has current page in xhtml type.
     *
     * @var bool
     */

    protected $blnIsXhtml = false;

    public function __construct(\Widget $objWidget)
    {
        // parse and generate methods append [] for multiple element widgets
        $objWidget->name = str_replace('[]', '', $objWidget->name);

        $this->objWidget = $objWidget;
        // fields cann add the correct dca by themselves since sometimes there isn't enough context here
        $this->arrDca = $objWidget->arrDca ?: $GLOBALS['TL_DCA'][$objWidget->strTable]['fields'][$objWidget->strField];

        global $objPage;

        $this->blnIsXhtml = ($objPage->outputFormat == 'xhtml');

        // use custom field template, named by type and widget name
        try {
            $strCustomTemplate = $this->strTemplate . '_' . $objWidget->name;
            \Controller::getTemplate($strCustomTemplate);
            $this->strTemplate = $strCustomTemplate;
        } catch (\Exception $e) {
        }

        // generate a unique ID
        $objWidget->id = $objWidget->id . '_' . rand(1000, 9999);
    }

    /**
     * Parse the template
     *
     * @return string
     */
    public function generate()
    {
        $this->Template              = new \FrontendTemplate($this->strTemplate);
        $this->Template->field       = $this->objWidget;
        $this->Template->attributes  = $this->objWidget->getAttributes();
        $this->Template->tagEnding   = $this->strTagEnding;
        $this->Template->hideLabel   = $this->hideLabel || $this->objWidget->hideLabel;
        $this->Template->explanation = $this->explanation || $this->objWidget->explanation;
        $this->Template->invisible   = $this->invisible || $this->objWidget->invisible;
        $this->Template->help        = $this->parseHelp();
        $this->setCssClasses();
        $this->setGroupCssClasses();

        $this->compile();

        $this->Template->class       = $this->getCssClasses();
        $this->Template->groupClass  = $this->getGroupCssClasses();
        $this->Template->attributes  = $this->objWidget->getAttributes();
        $this->Template->placeholder = $this->parsePlaceholder();

        return $this->Template->parse();
    }

    /**
     * Parse the error as help-block
     *
     * @return string
     */
    public function parseHelp()
    {
        $strText       = '';
        $arrCssClasses = ['help-block'];

        if ($this->objWidget->hasErrors()) {
            $strText = $this->objWidget->getErrorsAsString();
        } else {
            if ($this->getSetting(BOOTSTRAPPER_OPTION_SHOWDESCRIPTION)) {
                $strText = $this->objWidget->description;
            }
        }

        return strlen($strText) > 0 ? sprintf('<span class="%s">%s</span>', implode(' ', $arrCssClasses), $strText) : '';
    }

    /**
     * Return the attribute from DCA or the default value if not set
     *
     * @param        $strKey
     * @param string $varDefault
     *
     * @return string
     */
    public function getSetting($strKey)
    {
        if ($this->objWidget->{$strKey} !== null) {
            return $this->objWidget->{$strKey};
        }

        return $this->getDefaultSetting($strKey);
    }

    protected function getDefaultSetting($strKey)
    {
        switch ($strKey) {
            // true
            case BOOTSTRAPPER_OPTION_INLINE:
                $varDefault = true;
                break;
            // false
            case BOOTSTRAPPER_OPTION_HIDELABEL:
            case BOOTSTRAPPER_OPTION_SINGLESELECT:
            case BOOTSTRAPPER_OPTION_SHOWDESCRIPTION:
            case BOOTSTRAPPER_OPTION_SHOWGROUPLABEL:
                $varDefault = false;
                break;
            case BOOTSTRAPPER_OPTION_CHANGEFILE:
                $varDefault = $GLOBALS['TL_LANG']['bootstrapper'][BOOTSTRAPPER_OPTION_CHANGEFILE];
                break;
            case BOOTSTRAPPER_OPTION_REMOVEFILE:
                $varDefault = $GLOBALS['TL_LANG']['bootstrapper'][BOOTSTRAPPER_OPTION_REMOVEFILE];
                break;

            case BOOTSTRAPPER_OPTION_FILEICONCLASS:
                $varDefault = 'ei ei-document_alt';
                break;
            case BOOTSTRAPPER_OPTION_TOOLBAR:
                $varDefault = 'undo redo | bold italic | bullist numlist outdent indent | link unlink';
                break;
            case BOOTSTRAPPER_OPTION_CONTENTCSS:
                $varDefault = TL_PATH . '/system/themes/tinymce.css,' . TL_PATH . '/' . \Config::get('uploadPath') . '/tinymce.css';
                break;
            case BOOTSTRAPPER_OPTION_DISABLEOPTGROUPS:
                $varDefault = [];
                break;
            case BOOTSTRAPPER_OPTION_EXPLANATION:
                $varDefault = null;
                break;
            case BOOTSTRAPPER_OPTION_INVISIBLE:
                $varDefault = false;
                break;
        }

        return $varDefault;
    }

    /**
     * Return all css class names required for the input
     *
     * @return string
     */
    public function setCssClasses()
    {
        $this->arrCssClasses = [$this->objWidget->id];

        $arrClasses = trimsplit(' ', $this->getSetting('class'));

        if (is_array($arrClasses) && !empty($arrClasses)) {
            $this->arrCssClasses = array_merge($this->arrCssClasses, $arrClasses);
        }


        if ($this->objWidget->hasErrors()) {
            $this->arrCssClasses[] = BOOTSTRAPPER_ERROR_CLASS;
        }
    }

    /**
     * Return all css class names required for the input
     *
     * @return string
     */
    public function setGroupCssClasses()
    {
        $this->arrGroupCssClasses = [$this->objWidget->id];

        if ($this->objWidget->strName) {
            $this->arrGroupCssClasses[] = $this->objWidget->strName;
        }

        if ($this->objWidget->groupClass) {
            $this->arrGroupCssClasses[] = $this->objWidget->groupClass;
        }

        if ($this->objWidget->hasErrors()) {
            $this->arrGroupCssClasses[] = BOOTSTRAPPER_ERROR_CLASS;
        }

        $this->arrGroupCssClasses[] = BOOTSTRAPPER_FORM_GROUP_CLASS;
    }

    abstract protected function compile();

    public function getCssClasses()
    {
        if (!is_array($this->arrCssClasses)) {
            return '';
        }

        return trim(implode(' ', array_unique($this->arrCssClasses)));
    }

    public function getGroupCssClasses()
    {
        if (!is_array($this->arrGroupCssClasses)) {
            return '';
        }

        return trim(implode(' ', array_unique($this->arrGroupCssClasses)));
    }

    public function parsePlaceholder()
    {
        if (($strPlaceHolder = $this->getSetting('placeholder')) === null) {
            return '';
        }

        return ' placeholder="' . $strPlaceHolder . '"';
    }

    /**
     * Return an object property
     *
     * @param string $strKey
     *
     * @return mixed
     */
    public function __get($strKey)
    {
        if (isset($this->arrData[$strKey])) {
            return $this->arrData[$strKey];
        }

        return parent::__get($strKey);
    }

    /**
     * Set an object property
     *
     * @param string $strKey
     * @param mixed $varValue
     */
    public function __set($strKey, $varValue)
    {
        $this->arrData[$strKey] = $varValue;
    }

    /**
     * Check whether a property is set
     *
     * @param string $strKey
     *
     * @return boolean
     */
    public function __isset($strKey)
    {
        return isset($this->arrData[$strKey]);
    }

    public function addCssClass($strClass)
    {
        // check first char is not a number
        if (strlen($strClass) == 0 || preg_match('#^\d#', $strClass)) {
            return false;
        }

        $this->arrCssClasses[] = $strClass;
    }

    public function addGroupCssClass($strClass)
    {
        // check first char is not a number
        if (strlen($strClass) == 0 || preg_match('#^\d#', $strClass)) {
            return false;
        }

        $this->arrGroupCssClasses[] = $strClass;
    }

    /**
     * Return html attributes in correct syntax, considering doc type
     *
     * @param string $strKey
     * @param        $varValue
     *
     * @return string
     */
    protected function getHtmlAttributes(array $arrAttributes = [])
    {
        $arrOptions = [];

        foreach ($arrAttributes as $strKey => $varValue) {
            $arrOptions[] = $this->getHtmlAttribute($strKey, $varValue);
        }

        return implode(' ', $arrOptions);
    }

    /**
     * Return html attribute in correct syntax, considering doc type
     *
     * @param string $strKey
     * @param        $varValue
     *
     * @return string
     */
    protected function getHtmlAttribute($strKey, $varValue)
    {
        if ($strKey == 'disabled' || $strKey == 'readonly' || $strKey == 'required' || $strKey == 'autofocus' || $strKey == 'multiple') {
            $varValue = $strKey;
            return $this->blnIsXhtml ? ' ' . $strKey . '="' . $varValue . '"' : ' ' . $strKey;
        } else {
            return ' ' . $strKey . '="' . $varValue . '"';
        }

        return '';
    }
}
