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

	protected function compile()
	{
		$strOptions = '';

		$arrOptions = $this->objWidget->options;

		if (!isset($this->arrDca['options']) && !isset($this->arrDca['options_callback']) && !isset($this->arrDca['foreignKey']))
		{
			// do not use description for single checkboxes in frontend
			$arrOptions[0]['label'] = $this->objWidget->label;
		}

		foreach ($arrOptions as $i=>$arrOption)
		{
			$strOptions .= sprintf('<label id="lbl_%s" for="opt_%s"%s><input type="checkbox" name="%s" id="opt_%s" class="checkbox" value="%s"%s%s%s<span class="checkbox-label">%s</span></label>',
								   $this->objWidget->id.'_'.$i,
								   $this->objWidget->id.'_'.$i,
								   $this->getAttribute('inline', false) ? ' class="' . $this->objWidget->type. '-inline"' : '',
								   $this->objWidget->name . ((count($this->objWidget->options) > 1) ? '[]' : ''),
								   $this->objWidget->id.'_'.$i,
								   $arrOption['value'],
								   $this->objWidget->isChecked($arrOption),
								   $this->objWidget->getAttributes(),
								   $this->strTagEnding,
								   $arrOption['label']);
		}

		$this->Template->options = $strOptions;

		if($this->getAttribute('singleSelect'))	$this->addCssClass('checkbox-single-select');
	}
}