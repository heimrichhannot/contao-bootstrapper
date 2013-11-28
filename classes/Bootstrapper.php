<?php

namespace HeimrichHannot;

class Bootstrapper extends \Controller
{
	protected static $arrSkipTypes = array('hidden', 'fieldset', 'explanation', 'html', 'headline');

	public static function generateForm(\Widget $objWidget, $hideLabel=false)
	{
		if(in_array($objWidget->type, static::$arrSkipTypes)) return $objWidget->generate();

		$strTemplate = 'formbs_' . $objWidget->type;

		try
		{
			$objT = new \FrontendTemplate($strTemplate);
			$objT->field = $objWidget;
			$objT->hideLabel = $hideLabel;
			return $objT->parse();
		}
		catch(\Exception $e)
		{
			return $objWidget;
		}
	}

	public function parseWidgetHook($strBuffer, $objWidget)
	{
		if(TL_MODE == 'BE') return $strBuffer;

		$strBsForm = static::generateForm($objWidget, $objWidget->label == '');

		return is_object($strBsForm) ? $strBuffer : $strBsForm;
	}

}