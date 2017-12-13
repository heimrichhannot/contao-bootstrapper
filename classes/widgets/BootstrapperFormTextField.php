<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package ${CARET}
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;

use HeimrichHannot\Bootstrapper;

class BootstrapperFormTextField extends BootstrapperFormField
{
    protected $strTemplate = 'bootstrapper_form_text';

    protected function compile()
    {
        $arrEval = $this->arrDca['eval'];

        $this->Template->datepicker   = $arrEval['rgxp'] == 'datim' || $arrEval['rgxp'] == 'date';
        $this->Template->timepicker   = $arrEval['rgxp'] == 'time';
        $this->Template->datimepicker = $arrEval['rgxp'] == 'datim';
        $mode                         = $arrEval['rgxp'];
        $format                       = $flatPickrFormat = '';

        switch ($arrEval['rgxp']) {
            case 'datim':
                $flatPickrFormat = Bootstrapper::formatPhpDateToJsDateForFlatPickr($GLOBALS['TL_CONFIG']['datimFormat']);
                $format          = Bootstrapper::formatPhpDateToJsDate($GLOBALS['TL_CONFIG']['datimFormat']);
                break;
            case 'date':
                $flatPickrFormat = Bootstrapper::formatPhpDateToJsDateForFlatPickr($GLOBALS['TL_CONFIG']['dateFormat']);
                $format          = Bootstrapper::formatPhpDateToJsDate($GLOBALS['TL_CONFIG']['dateFormat']);
                break;
            case 'time':
                $flatPickrFormat = Bootstrapper::formatPhpDateToJsDateForFlatPickr($GLOBALS['TL_CONFIG']['timeFormat']);
                $format          = Bootstrapper::formatPhpDateToJsDate($GLOBALS['TL_CONFIG']['timeFormat']);
                break;
        }

        $this->objWidget->addAttribute('data-date-format', $flatPickrFormat);
        $this->objWidget->addAttribute('data-moment-date-format', $format);

        if ($this->objWidget->value)
        {
            $this->Template->defaultValue = $this->arrDca['default'];
        }

        if ($mode == 'datim' || $mode == 'date' || $mode == 'time') {
            $this->objWidget->addAttribute('data-input', '1');
        }

        if ($mode == 'datim' || $mode == 'time') {
            $this->objWidget->addAttribute('data-enable-time', 'true');

            if ($this->getSetting(BOOTSTRAPPER_OPTION_MINUTE_STEPS)) {
                $this->objWidget->addAttribute('data-minute-increment', $this->getSetting(BOOTSTRAPPER_OPTION_MINUTE_STEPS));
            }
        }

        if ($mode == 'time') {
            $this->objWidget->addAttribute('data-no-calendar', 'true');
        }

        if ($mode == 'datim' || $mode == 'date') {
            if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_START)) {
                $this->objWidget->addAttribute('data-linked-start', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_START));
                $this->objWidget->addAttribute('data-toggle', 'tooltip');
                $this->objWidget->addAttribute('data-title', $this->label);
            }

            if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_END)) {
                $this->objWidget->addAttribute('data-linked-end', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_END));
                $this->objWidget->addAttribute('data-toggle', 'tooltip');
                $this->objWidget->addAttribute('data-title', $this->label);
            }

            if ($this->getSetting(BOOTSTRAPPER_OPTION_MIN_DATE)) {
                $this->objWidget->addAttribute('data-min-date',
                    date($format, $this->getSetting(BOOTSTRAPPER_OPTION_MIN_DATE))
                );
            }

            if ($this->getSetting(BOOTSTRAPPER_OPTION_MAX_DATE)) {
                $this->objWidget->addAttribute('data-max-date',
                    date($format, $this->getSetting(BOOTSTRAPPER_OPTION_MAX_DATE))
                );
            }
        }
    }
}