<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package bootstrapper
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;


class BootstrapperFormCheckBox extends BootstrapperFormField
{
	protected $strTemplate = 'bootstrapper_form_checkbox';
	protected $blnCanBeMultiple = true;

	protected function compile()
	{
		$strOptions = '';

		$arrOptions        = $this->objWidget->options;
		$blnShowGroupLabel = true;

		if ($this->arrDca !== null && !isset($this->arrDca['options']) && !isset($this->arrDca['options_callback'])	&& !isset($this->arrDca['foreignKey'])) {
			// do not use description for single checkboxes in frontend
			$arrOptions[0]['label'] = $this->objWidget->label;
			$blnShowGroupLabel      = false;
		}

		$strOptionTemplate = $this->strTemplate . '_option';

		try {
			$strCustomTemplate = $strOptionTemplate . '_' . $this->objWidget->name;
			\Controller::getTemplate($strCustomTemplate);
			$strOptionTemplate = $strCustomTemplate;
		} catch (\Exception $e) {
		}

		foreach ($arrOptions as $i => $arrOption)
		{
			$objOptionTemplate = new \FrontendTemplate($strOptionTemplate);

			$objLabel        = new \stdClass();
			$objLabel->id    = 'lbl_' . $this->objWidget->id . '_' . $i;
			$objLabel->for   = 'opt_' . $this->objWidget->id . '_' . $i;
			$objLabel->class = $this->getSetting(BOOTSTRAPPER_OPTION_INLINE) ? ' class="' . $this->objWidget->type . '-inline"' : '';
			$objLabel->value = $arrOption['label'];

			$arrData = array
			(
				'label'      => $objLabel,
				'type'       => $this->objWidget->type,
				'name'       => $this->objWidget->name . ((count($this->objWidget->options) > 1 && $this->blnCanBeMultiple) ? '[]' : ''),
				'id'         => 'opt_' . $this->objWidget->id . '_' . $i,
				'class'      => $this->objWidget->type,
				'value'      => $arrOption['value'],
				'checked'    => $this->objWidget->isChecked($arrOption),
				'attributes' => $this->objWidget->getAttributes(),
				'tagEnding'  => $this->strTagEnding,
			);

			$objOptionTemplate->setData($arrData);

			$strOptions .= $objOptionTemplate->parse();
		}

		$this->Template->options = $strOptions;
		$this->Template->groupID = sprintf("%s_%s", $this->objWidget->type, $this->objWidget->id);

		if (!$this->getSetting(BOOTSTRAPPER_OPTION_HIDELABEL) && $blnShowGroupLabel || $this->getSetting(BOOTSTRAPPER_OPTION_SHOWGROUPLABEL)) {
			$this->Template->showGroupLabel = true;
			$this->Template->groupLabel     = $this->objWidget->label;
			

		}

		if ($this->getSetting(BOOTSTRAPPER_OPTION_SINGLESELECT)) {
			$this->addCssClass('checkbox-single-select');
		}
	}
}