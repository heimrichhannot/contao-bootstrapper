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
define('BOOTSTRAPPER_OPTION_CHANGEFILE', 'changeFile');
define('BOOTSTRAPPER_OPTION_REMOVEFILE', 'removeFile');
define('BOOTSTRAPPER_OPTION_FILEICONCLASS', 'fileIconClass');
define('BOOTSTRAPPER_OPTION_SINGLESELECT', 'singleSelect');
define('BOOTSTRAPPER_OPTION_SHOWDESCRIPTION', 'showDescription');
define('BOOTSTRAPPER_OPTION_INLINE', 'inline');
define('BOOTSTRAPPER_OPTION_TOOLBAR', 'toolbar');
define('BOOTSTRAPPER_OPTION_CONTENTCSS', 'content_css');

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
	protected $arrData = array();

	/**
	 * Css classes
	 *
	 * @var array
	 */
	protected $arrCssClasses = array();

	/**
	 * Css classes for form-group
	 *
	 * @var array
	 */
	protected $arrGroupCssClasses = array();


	/**
	 * The dca config of the field
	 * @var array
	 */
	protected $arrDca = array();


	public function __construct(\Widget $objWidget)
	{
		// parse and generate methods append [] for multiple element widgets
		$objWidget->name = str_replace('[]', '', $objWidget->name);
		
		$this->objWidget = $objWidget;
		$this->arrDca = $GLOBALS['TL_DCA'][$objWidget->strTable]['fields'][$objWidget->strField];
		
		// use custom field template, named by type and widget name
		try {
			$strCustomTemplate = $this->strTemplate . '_' . $objWidget->name;
			\Controller::getTemplate($strCustomTemplate);
			$this->strTemplate = $strCustomTemplate;
		} catch (\Exception $e) {
		}
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
		$this->Template->help       =  $this->parseHelp();
		$this->setCssClasses();
		$this->setGroupCssClasses();

		$this->compile();

		$this->Template->class       = $this->getCssClasses();
		$this->Template->groupClass =  $this->getGroupCssClasses();
		$this->Template->attributes  = $this->objWidget->getAttributes();

		return $this->Template->parse();
	}

	/**
	 * Set an object property
	 *
	 * @param string $strKey
	 * @param mixed  $varValue
	 */
	public function __set($strKey, $varValue)
	{
		$this->arrData[$strKey] = $varValue;
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
		if (isset($this->objWidget->{$strKey}))
		{
			return $this->objWidget->{$strKey};
		}

		return $this->getDefaultSetting($strKey);
	}


	protected function getDefaultSetting($strKey)
	{
		switch ($strKey)
		{
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
				$varDefault = 'fa fa-file';
				break;
			case BOOTSTRAPPER_OPTION_TOOLBAR:
				$varDefault = 'undo redo | bold italic | bullist numlist outdent indent | link unlink';
				break;
			case BOOTSTRAPPER_OPTION_CONTENTCSS:
				$varDefault = TL_PATH . '/system/themes/tinymce.css,' . TL_PATH . '/' . Config::get('uploadPath') . '/tinymce.css';
				break;
		}

		return $varDefault;
	}

	/**
	 * Parse the error as help-block
	 *
	 * @return string
	 */
	public function parseHelp()
	{
		$strText = '';
		$arrCssClasses = array('help-block');

		if($this->objWidget->hasErrors())
		{
			$strText = $this->objWidget->getErrorsAsString();
		}
		else if($this->getSetting(BOOTSTRAPPER_OPTION_SHOWDESCRIPTION))
		{
			$strText = $this->objWidget->description;
		}

		return strlen($strText) > 0 ? sprintf('<span class="%s">%s</span>', implode(' ', $arrCssClasses), $strText) : '';
	}

	/**
	 * Return all css class names required for the input
	 *
	 * @return string
	 */
	public function setCssClasses()
	{
		$this->arrCssClasses = array($this->objWidget->id);

		if ($this->objWidget->hasErrors()) {
			$this->arrCssClasses[] = BOOTSTRAPPER_ERROR_CLASS;
		}
	}

	public function addCssClass($strClass)
	{
		// check first char is not a number
		if(strlen($strClass) == 0 ||  preg_match('#^\d#', $strClass)) return false;

		$this->arrCssClasses[] = $strClass;
	}

	public function getCssClasses()
	{
		if(!is_array($this->arrCssClasses)) return '';

		return implode(' ', $this->arrCssClasses);
	}

	/**
	 * Return all css class names required for the input
	 *
	 * @return string
	 */
	public function setGroupCssClasses()
	{
		$this->arrGroupCssClasses = array($this->objWidget->id);

		if ($this->objWidget->hasErrors()) {
			$this->arrGroupCssClasses[] = BOOTSTRAPPER_ERROR_CLASS;
		}

		$this->arrGroupCssClasses[] = BOOTSTRAPPER_FORM_GROUP_CLASS;
	}

	public function addGroupCssClass($strClass)
	{
		// check first char is not a number
		if(strlen($strClass) == 0 ||  preg_match('#^\d#', $strClass)) return false;

		$this->arrGroupCssClasses[] = $strClass;
	}

	public function getGroupCssClasses()
	{
		if(!is_array($this->arrGroupCssClasses)) return '';

		return implode(' ', $this->arrGroupCssClasses);
	}

	abstract protected function compile();
}