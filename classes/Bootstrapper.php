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
		// check if field is part of a sub palette
// 		$dc = $GLOBALS['TL_DCA']['tl_calendar_events'];
// 		// add alias as hidden field, for trigger the save callback (generateAlias)
// 		$dc['fields']['alias']['inputType'] = 'hidden';
		
		
		$objT->field = $objWidget;
		$objT->hideLabel = $hideLabel;
		return $objT->parse();
	}

	public function parseWidgetHook($strBuffer, $objWidget)
	{
		if(TL_MODE == 'BE') return $strBuffer;

		return static::generateForm($objWidget, empty($objWidget->label));
	}

}