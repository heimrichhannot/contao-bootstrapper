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

	protected function compile() {
		$arrEval = $this->arrDca['eval'];

		if ($arrEval['rgxp'] == 'datim')
		{
			$this->Template->datepicker = true;
			$this->Template->timepicker = true;

			$this->objWidget->addAttribute('data-format',
				Bootstrapper::formatPhpDateToJsDate($GLOBALS['TL_CONFIG']['datimFormat']));

			if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_START))
			{
				if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_UNLOCK))
					$this->objWidget->addAttribute('data-linked-unlock', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_UNLOCK));

				$this->objWidget->addAttribute('data-linked-start', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_START));
				$this->objWidget->addAttribute('data-toggle', 'tooltip');
				$this->objWidget->addAttribute('data-title', $this->label);
			}

			if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_END))
			{
				if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_UNLOCK))
					$this->objWidget->addAttribute('data-linked-unlock', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_UNLOCK));

				$this->objWidget->addAttribute('data-linked-end', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_END));
				$this->objWidget->addAttribute('data-toggle', 'tooltip');
				$this->objWidget->addAttribute('data-title', $this->label);
			}

			if ($this->getSetting(BOOTSTRAPPER_OPTION_MIN_DATE))
				$this->objWidget->addAttribute('data-minDate', $this->getSetting(BOOTSTRAPPER_OPTION_MIN_DATE));

			if ($this->getSetting(BOOTSTRAPPER_OPTION_MAX_DATE))
				$this->objWidget->addAttribute('data-maxDate', $this->getSetting(BOOTSTRAPPER_OPTION_MAX_DATE));

			if ($this->getSetting(BOOTSTRAPPER_OPTION_MINUTE_STEPS))
				$this->objWidget->addAttribute('data-steps', $this->getSetting(BOOTSTRAPPER_OPTION_MINUTE_STEPS));
		}
		elseif ($arrEval['datepicker'] || $arrEval['rgxp'] == 'date')
		{
			$this->Template->datepicker = true;

			$this->objWidget->addAttribute('data-format',
					Bootstrapper::formatPhpDateToJsDate($GLOBALS['TL_CONFIG']['dateFormat']));

			if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_START))
			{
				if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_UNLOCK))
					$this->objWidget->addAttribute('data-linked-unlock', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_UNLOCK));

				$this->objWidget->addAttribute('data-linked-start', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_START));
				$this->objWidget->addAttribute('data-toggle', 'tooltip');
				$this->objWidget->addAttribute('data-title', $this->label);
			}

			if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_END))
			{
				if ($this->getSetting(BOOTSTRAPPER_OPTION_LINKED_UNLOCK))
					$this->objWidget->addAttribute('data-linked-unlock', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_UNLOCK));

				$this->objWidget->addAttribute('data-linked-end', $this->getSetting(BOOTSTRAPPER_OPTION_LINKED_END));
				$this->objWidget->addAttribute('data-toggle', 'tooltip');
				$this->objWidget->addAttribute('data-title', $this->label);
			}

			if ($this->getSetting(BOOTSTRAPPER_OPTION_MIN_DATE))
				$this->objWidget->addAttribute('data-minDate', $this->getSetting(BOOTSTRAPPER_OPTION_MIN_DATE));

			if ($this->getSetting(BOOTSTRAPPER_OPTION_MAX_DATE))
				$this->objWidget->addAttribute('data-maxDate', $this->getSetting(BOOTSTRAPPER_OPTION_MAX_DATE));
		}
		elseif ($arrEval['timepicker'] || $arrEval['rgxp'] == 'time')
		{
			$this->Template->timepicker = true;

			$this->objWidget->addAttribute('data-format',
					Bootstrapper::formatPhpDateToJsDate($GLOBALS['TL_CONFIG']['timeFormat']));

			if ($this->getSetting(BOOTSTRAPPER_OPTION_MINUTE_STEPS))
				$this->objWidget->addAttribute('data-steps', $this->getSetting(BOOTSTRAPPER_OPTION_MINUTE_STEPS));

			if ($this->getSetting(BOOTSTRAPPER_OPTION_MIN_DATE))
				$this->objWidget->addAttribute('data-minDate', $this->getSetting(BOOTSTRAPPER_OPTION_MIN_DATE));

			if ($this->getSetting(BOOTSTRAPPER_OPTION_MAX_DATE))
				$this->objWidget->addAttribute('data-maxDate', $this->getSetting(BOOTSTRAPPER_OPTION_MAX_DATE));
		}
	}
}