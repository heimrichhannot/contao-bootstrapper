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

		if ($this->blnUseAwesomeInputs)
			$this->strTemplate .= '_awesome';
		
		$strOptionTemplate = $this->strTemplate . '_option';

		try {
			$strCustomTemplate = $strOptionTemplate . '_' . $this->objWidget->name;
			\Controller::getTemplate($strCustomTemplate);
			$strOptionTemplate = $strCustomTemplate;
		} catch (\Exception $e) {
		}

		foreach ($arrOptions as $strKey => $arrOption)
		{
			$strOptions .=  $this->parseOption($arrOption, $strKey, $strOptionTemplate);
		}

		$this->Template->options = $strOptions;
		$this->Template->groupID = sprintf("%s_%s", $this->objWidget->type, $this->objWidget->id);
		$this->Template->groupLabel     = $this->objWidget->groupLabel ?: $this->objWidget->label;
		$this->Template->explanation     = $this->objWidget->explanation;
		$this->Template->invisible     = $this->objWidget->invisible;

		if (!$this->getSetting(BOOTSTRAPPER_OPTION_HIDELABEL) && $blnShowGroupLabel || $this->getSetting(BOOTSTRAPPER_OPTION_SHOWGROUPLABEL)) {
			$this->Template->showGroupLabel = true;
		}

		if ($this->getSetting(BOOTSTRAPPER_OPTION_SINGLESELECT)) {
			$this->addCssClass('checkbox-single-select');
		}
	}

	protected function parseOption(array $arrOption = array(), $strKey, $strOptionTemplate)
	{
		$objOptionTemplate = new \FrontendTemplate($strOptionTemplate);

		$objLabel        = new \stdClass();
		$objLabel->id    = 'lbl_' . $this->objWidget->id . '_' . $strKey;
		$objLabel->for   = 'opt_' . $this->objWidget->id . '_' . $strKey;

		if ($this->blnUseAwesomeInputs)
			$objLabel->class = $this->getSetting(BOOTSTRAPPER_OPTION_INLINE) ? $this->objWidget->type . '-inline' : '';
		else
			$objLabel->class = $this->getSetting(BOOTSTRAPPER_OPTION_INLINE) ? ' class="' . $this->objWidget->type . '-inline"' : '';

		$objLabel->value = $arrOption['label'];
		$objLabel->attributes = array();

		$arrStrAttributes = trimsplit(' ', $this->objWidget->getAttributes());

		$arrData = array
		(
			'label'      => $objLabel,
			'type'       => $this->objWidget->type,
			'name'       => $this->objWidget->name . ((count($this->objWidget->options) > 1 && $this->blnCanBeMultiple) ? '[]' : ''),
			'field'		 => $this->objWidget->name,
			'id'         => 'opt_' . $this->objWidget->id . '_' . $strKey,
			'class'      => $this->objWidget->type,
			'value'      => $arrOption['value'],
			'checked'    => $this->objWidget->isChecked($arrOption),
			'attributes' => array(),
			'tagEnding'  => $this->strTagEnding,
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

		$objOptionTemplate->attributes = $this->objWidget->getAttributes();

		if(is_array($arrData['attributes']))
		{
			$objOptionTemplate->attributes .= ' ' . $this->getHtmlAttributes($arrData['attributes']);
		}

		if(is_array($arrData['label']->attributes))
		{
			$objOptionTemplate->labelAttributes = ' ' . $this->getHtmlAttributes($arrData['label']->attributes);
		}

		return $objOptionTemplate->parse();
	}

}