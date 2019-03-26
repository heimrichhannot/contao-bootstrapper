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

        if (!is_array($arrComponents)) {
            return false;
        }

        $arrJs  = is_array($GLOBALS['TL_JAVASCRIPT']) ? $GLOBALS['TL_JAVASCRIPT'] : [];
        $arrCss = is_array($GLOBALS['TL_USER_CSS']) ? $GLOBALS['TL_USER_CSS'] : [];

        foreach ($arrComponents as $group => $arrComponent) {
            $arrJs  = static::addComponents($group, $arrComponent['js'], $arrJs);
            $arrCss = static::addComponents($group, $arrComponent['css'], $arrCss);
        }

        $GLOBALS['TL_JAVASCRIPT'] = $arrJs;
        $GLOBALS['TL_USER_CSS']   = $arrCss;
    }

    public static function getActiveComponents(\LayoutModel $objLayout)
    {
        $arrAvailable = static::getComponents();

        if ($objLayout->bs_disable_components) {
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
        $arrOptions = [];

        $arrComponents = $GLOBALS['BOOTSTRAPPER_ASSET_COMPONENTS'];

        if (!is_array($arrComponents)) {
            return $arrOptions;
        }

        foreach ($arrComponents as $groupKey => $arrGroup) {
            $varValue = $arrGroup;

            if ($blnGroup) {
                $varValue = $groupKey;
            }

            $arrOptions[$groupKey] = $varValue;
        }

        return $arrOptions;
    }

    public static function addComponents($strGroup, $arrNew = [], $arrCurrent = [])
    {
        if (!isset($arrNew['files'])) {
            return $arrCurrent;
        }

        $arrFiles = $arrNew['files'];
        $intIndex = $arrNew['sort'];

        if (!is_array($arrFiles)) {
            $arrFiles = [$arrFiles];
        }

        if (!is_array($arrCurrent)) {
            $arrCurrent = [$arrCurrent];
        }

        $arrReplace = [];

        foreach ($arrFiles as $key => $strFile) {
            // do not add the same file multiple times
            if (in_array($strFile, $arrCurrent)) {
                continue;
            }

            $arrReplace[$strGroup . '.' . $key] = $strFile;
        }

        if ($intIndex !== null) {
            array_insert($arrCurrent, $intIndex, $arrReplace);
            return $arrCurrent;
        }

        return $arrCurrent + $arrReplace;
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