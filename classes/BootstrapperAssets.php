<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2016 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;


class BootstrapperAssets extends \Frontend
{

	public static function registerComponents(\LayoutModel $objLayout)
	{
		$arrComponents = static::getActiveComponents($objLayout);

		if(!is_array($arrComponents))
		{
			return false;
		}

		$arrJs = array();
		$arrCss = array();

		foreach($arrComponents as $group => $arrComponent)
		{
			if(isset($arrComponent['js']) )
			{
				if(!is_array($arrComponent['js']))
				{
					$arrComponent['js'] = array($arrComponent);
				}

				$arrJs = array_merge($arrJs, $arrComponent['js']);
			}

			if(isset($arrComponent['css']))
			{
				if(!is_array($arrComponent['css']))
				{
					$arrComponent['css'] = array($arrComponent);
				}

				$arrCss = array_merge($arrCss, $arrComponent['css']);
			}
		}

		$GLOBALS['TL_JAVASCRIPT'] = is_array($GLOBALS['TL_JAVASCRIPT']) ? array_merge($GLOBALS['TL_JAVASCRIPT'], $arrJs) : $arrJs;
		$GLOBALS['TL_USER_CSS'] = is_array($GLOBALS['TL_USER_CSS']) ? array_merge($GLOBALS['TL_USER_CSS'], $arrCss) : $arrCss;
	}

	public static function getActiveComponents(\LayoutModel $objLayout)
	{
		$arrAvailable = static::getComponents();
		
		if($objLayout->bs_disable_components)
		{
			$arrDisabled = deserialize($objLayout->bs_disabled_components, true);

			$arrAvailable = array_diff_key($arrAvailable, array_flip($arrDisabled));
		}

		return $arrAvailable;
	}


	/**
	 * Return assets components as array
	 * @return array of components
	 */
	public static function getComponents($blnGroup = false)
	{
		$arrOptions = array();

		$arrComponents = $GLOBALS['BOOTSTRAPPER_ASSET_COMPONENTS'];

		if(!is_array($arrComponents))
		{
			return $arrOptions;
		}

		foreach($arrComponents as $groupKey => $arrGroup)
		{
			$varValue = $arrGroup;

			if($blnGroup)
			{
				$varValue = $groupKey;
			}

			$arrOptions[$groupKey] = $varValue;
		}

		return $arrOptions;
	}

	/**
	 * Return key as value of javascript components as array
	 * @return array of js components
	 */
	public static function getComponentGroups()
	{
		return static::getComponents(true);
	}
}