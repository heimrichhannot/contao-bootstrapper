<?php

namespace HeimrichHannot;

class Bootstrapper extends \Controller
{
	protected static $arrSkipTypes = array('hidden');

	public static function generateForm(\Widget $objWidget, $hideLabel=false)
	{
		if(in_array($objWidget->type, static::$arrSkipTypes)) return $objWidget->generate();

		$strTemplate = 'bootstrapper_form';

		$objT = new \FrontendTemplate($strTemplate);
		$objT->field = $objWidget;
		$objT->hideLabel = $hideLabel;
		return $objT->parse();
	}

}