<?php

namespace HeimrichHannot;

class Bootstrapper extends \Controller
{

	public static function generateForm(\Widget $objWidget)
	{
		$strTemplate = 'bootstrapper_form';

		$objT = new \FrontendTemplate($strTemplate);
		$objT->field = $objWidget;
		return $objT->parse();
	}

}