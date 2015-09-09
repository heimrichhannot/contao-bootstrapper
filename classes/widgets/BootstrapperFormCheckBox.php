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
		$blnShowGroupLabel = true;

		if (!isset($this->arrDca['options']) && !isset($this->arrDca['options_callback']) && !isset($this->arrDca['foreignKey']))
		{
			// do not use description for single checkboxes in frontend
			$arrOptions[0]['label'] = $this->objWidget->label;
			$blnShowGroupLabel = false;
		}

		foreach ($arrOptions as $i=>$arrOption)
		{
			$strOptions .= sprintf('<label id="lbl_%s" for="opt_%s"%s><input type="%s" name="%s" id="opt_%s" class="%s" value="%s"%s%s%s<span class="%s">%s</span></label>',
								   $this->objWidget->id.'_'.$i,
								   $this->objWidget->id.'_'.$i,
								   $this->getSetting(BOOTSTRAPPER_OPTION_INLINE) ? ' class="' . $this->objWidget->type . '-inline"' : '',
								   $this->objWidget->type,
								   $this->objWidget->name . ((count($this->objWidget->options) > 1) ? '[]' : ''),
								   $this->objWidget->id.'_'.$i,
								   $this->objWidget->type,
								   $arrOption['value'],
								   $this->objWidget->isChecked($arrOption),
								   $this->objWidget->getAttributes(),
								   $this->strTagEnding,
								   $this->objWidget->type . '-label',
								   $arrOption['label']);
		}

		$this->Template->options = $strOptions;
		$this->Template->groupID = sprintf("%s_%s", $this->objWidget->type, $this->objWidget->id);

		if(!$this->getSetting(BOOTSTRAPPER_OPTION_HIDELABEL) && $blnShowGroupLabel)
		{
			$this->Template->showGroupLabel = true;
			$this->Template->groupLabel = $this->objWidget->label;
		}

		if($this->getSetting(BOOTSTRAPPER_OPTION_SINGLESELECT))	$this->addCssClass('checkbox-single-select');
	}
}