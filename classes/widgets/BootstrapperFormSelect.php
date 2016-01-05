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

class BootstrapperFormSelect extends BootstrapperFormField
{
	protected $strTemplate = 'bootstrapper_form_select';

	protected function compile()
	{
		$arrOptions        = $this->objWidget->options;
		$blnShowGroupLabel = true;
		
		$strOptionTemplate = $this->strTemplate . '_option';
		$strOptGroupTemplate = $this->strTemplate . '_optgroup';

		try {
			$strCustomTemplate = $strOptionTemplate . '_' . $this->objWidget->name;
			\Controller::getTemplate($strCustomTemplate);
			$strOptionTemplate = $strCustomTemplate;
		} catch (\Exception $e) {
		}

		try {
			$strCustomTemplate = $strOptGroupTemplate . '_' . $this->objWidget->name;
			\Controller::getTemplate($strCustomTemplate);
			$strOptGroupTemplate = $strCustomTemplate;
		} catch (\Exception $e) {
		}

		$arrCustomOptions = array();
		$arrDisableGroups = $this->getSetting(BOOTSTRAPPER_OPTION_DISABLEOPTGROUPS);


		foreach ($arrOptions as $strKey => $arrOption)
		{
			if (isset($arrOption['value']))
			{
				$arrCustomOptions[] = $this->parseOption($arrOption, $strKey, $strOptionTemplate);
			}
			else
			{
				$arrOptgroups = array();

				foreach ($arrOption as $arrOptgroup)
				{
					$arrOptgroups[] = $this->parseOption($arrOptgroup, $strKey, $strOptionTemplate);
				}

				$arrCustomOptions[] = $this->parseOptGroup($strKey, $arrOptgroups, $strOptGroupTemplate, $arrDisableGroups);
			}
		}

		// for multiple select menu set blankOption as title attribute, required by bootstrap-select for example
		if ($this->arrDca['eval']['includeBlankOption'] && $this->arrDca['eval']['multiple'])
		{
			$strLabel = isset($this->arrDca['eval']['blankOptionLabel']) ? $this->arrDca['eval']['blankOptionLabel'] : '-';
			$this->objWidget->addAttribute('title', $strLabel);
		}

		$this->Template->options = implode('', $arrCustomOptions);
		$this->Template->groupID = sprintf("%s_%s", $this->objWidget->type, $this->objWidget->id);
		$this->Template->name = $this->objWidget->name;

		if ($this->objWidget->multiple)
		{
			$this->Template->name .= '[]';
			$this->addCssClass('multiselect');
		}
	}

	protected function parseOption(array $arrOption = array(), $strKey, $strOptionTemplate)
	{
		$objOptionTemplate = new \FrontendTemplate($strOptionTemplate);

		$objLabel        = new \stdClass();
		$objLabel->value = $arrOption['label'];

		$arrData = array
		(
			'label'      => $objLabel,
			'type'       => $this->objWidget->type,
			'name'       => $this->objWidget->name,
			'id'         => 'opt_' . $this->objWidget->id . '_' . $strKey,
			'class'      => $this->objWidget->type,
			'value'      => $arrOption['value'],
			'selected'   => $this->objWidget->isSelected($arrOption), // select menu
			'attributes' => $this->objWidget->getAttributes(),
			'tagEnding'  => $this->strTagEnding,
		);

		$objOptionTemplate->setData($arrData);

		return $objOptionTemplate->parse();
	}

	protected function parseOptGroup($strKey, array $arrOptions = array(), $strOptGroupTemplate, array $arrDisableGroups=array())
	{
		$objTemplate = new \FrontendTemplate($strOptGroupTemplate);
		$objTemplate->label = $strKey;
		$objTemplate->options = implode('',$arrOptions);

		if(in_array($strKey, $arrDisableGroups))
		{
			$objTemplate->disabled = $this->getHtmlAttribute('disabled');
		}

		return $objTemplate->parse();
	}
}