<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package beg-web
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;


abstract class BootstrapperComponent
{
	protected $strTemplate;

	protected $strTag;

	protected $arrParam;

	public function __construct($strTag, $arrParam)
	{
		$this->strTag = $strTag;
		$this->arrParam = $arrParam;
	}

	/**
	 * Parse the template
	 *
	 * @return string
	 */
	public function generate()
	{
		$this->Template = new \FrontendTemplate($this->strTemplate);

		$this->compile();

		return $this->Template->parse();
	}

	abstract protected function compile();
}