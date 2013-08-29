<?php

namespace HeimrichHannot;

class Bootstrapper extends \Controller
{

	public static function generateForm(\Widget $objWidget)
	{
		$objT = new \FrontendTemplate('bootstrapper_form');
		$objT->field = $objWidget;
		return $objT->parse();
	}

}