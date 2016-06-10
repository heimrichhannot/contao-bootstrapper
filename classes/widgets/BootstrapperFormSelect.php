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

		if ($this->arrDca['eval']['size'])
		{
			$this->objWidget->addAttribute('size', $this->arrDca['eval']['size']);
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
			'tagEnding'  => $this->strTagEnding,
			'attributes' => array(),
		);

		// Trigger option_callback
		if (is_array($this->arrDca['option_callback']))
		{
			foreach ($this->arrDca['option_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$arrData = $this->{$callback[0]}->{$callback[1]}($strKey, $arrData);
				}
				elseif (is_callable($callback))
				{
					$arrData = $callback($strKey, $arrData);
				}
			}
		}

		$objOptionTemplate->setData($arrData);


		if(is_array($arrData['attributes']))
		{
			$objOptionTemplate->attributes = $this->getHtmlAttributes($arrData['attributes']);
		}

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