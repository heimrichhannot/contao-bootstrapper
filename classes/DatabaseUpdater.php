<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @package anwaltverein
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;

class DatabaseUpdater
{

    public static function run()
    {
        $objDatabase = \Database::getInstance();

        $arrRenameFields = [
            'tl_layout' => [
                'bs_disable_components'  => [
                    'name'      => 'disableComponents',
                    'syncValue' => true,
                ],
                'bs_disabled_components' => [
                    'name'      => 'inactiveComponents',
                    'syncValue' => true,
                ],
            ],
        ];

        foreach ($arrRenameFields as $strTable => $arrFields) {
            if (!$objDatabase->tableExists($strTable)) {
                continue;
            }

            \Controller::loadDataContainer($strTable);

            foreach ($arrFields as $strOldName => $arrConfig) {
                if (!$objDatabase->fieldExists($strOldName, $strTable)) {
                    continue;
                }

                $strNewName = $arrConfig['name'];
                $sql        = &$GLOBALS['TL_DCA']['tl_module']['fields'][$strNewName]['sql'];

                if (!$objDatabase->fieldExists($arrConfig['name'], $strTable) && $sql) {
                    $sql = &$GLOBALS['TL_DCA']['tl_module']['fields'][$strNewName]['sql'];
                    $objDatabase->query("ALTER TABLE $strTable ADD `$strNewName` $sql");
                }

                if (!$arrConfig['syncValue']) {
                    continue;
                }

                $objDatabase->prepare('UPDATE ' . $strTable . ' SET ' . $arrConfig['name'] . ' = ' . $strOldName)->execute();
            }
        }

        return;
    }
} 