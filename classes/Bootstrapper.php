<?php

namespace HeimrichHannot;

use HeimrichHannot\Bootstrapper\BootstrapperFormField;

class Bootstrapper extends \Controller
{
	protected static $arrSkipTypes = array('hidden', 'fieldset', 'subEventList', 'explanation', 'successGroup', 'formcolstart', 'formcolpart', 'formcolend', 'multiColumnWizard', 'form_multiColumnWizard', 'multifileupload');

	public static function generateForm(\Widget $objWidget, $hideLabel=false)
	{
		if(in_array($objWidget->type, static::$arrSkipTypes))
		{
			return $objWidget->generate();
		}

		$strClass = $GLOBALS['TL_FFL_BOOTSTRAPPER']['legacy'];

		if(isset($GLOBALS['TL_FFL_BOOTSTRAPPER'][$objWidget->type]))
		{
			$strClass = $GLOBALS['TL_FFL_BOOTSTRAPPER'][$objWidget->type];
		}

		if(!class_exists($strClass))
		{
			return $objWidget->generate();
		}

		$objField = new $strClass($objWidget);

		if(!$objField instanceof BootstrapperFormField)
		{
			return $objWidget->generate();
		}

		$objField->hideLabel = $hideLabel;

		return $objField->generate();
	}

	public static function formatPhpDateToJsDate($php_format) {
		$SYMBOLS_MATCHING = array (
				// Day
				'd' => 'DD',
				'D' => 'D',
				'j' => 'd',
				'l' => 'DD',
				'N' => '',
				'S' => '',
				'w' => '',
				'z' => 'o',
				// Week
				'W' => '',
				// Month
				'F' => 'MM',
				'm' => 'MM',
				'M' => 'M',
				'n' => 'm',
				't' => '',
				// Year
				'L' => '',
				'o' => '',
				'Y' => 'YYYY',
				'y' => 'y',
				// Time
				'a' => '',
				'A' => '',
				'B' => '',
				'g' => '',
				'G' => '',
				'h' => '',
				'H' => 'HH',
				'i' => 'mm',
				's' => '',
				'u' => '' 
		);
		
		$jqueryui_format = "";
		$escaping = false;
		
		for($i = 0; $i < strlen ( $php_format ); $i ++)
		{
			$char = $php_format [$i];
			if ($char === '\\') 			// PHP date format escaping character
			{
				$i ++;
				if ($escaping)
					$jqueryui_format .= $php_format [$i];
				else
					$jqueryui_format .= '\'' . $php_format [$i];
				$escaping = true;
			} else {
				if ($escaping) {
					$jqueryui_format .= "'";
					$escaping = false;
				}
				if (isset ( $SYMBOLS_MATCHING [$char] ))
					$jqueryui_format .= $SYMBOLS_MATCHING [$char];
				else
					$jqueryui_format .= $char;
			}
		}
		return $jqueryui_format;
	}
}
