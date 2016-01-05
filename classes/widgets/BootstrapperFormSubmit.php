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

class BootstrapperFormSubmit extends BootstrapperFormField
{
	protected $strTemplate = 'bootstrapper_form_submit';

	protected function compile()
	{
		$this->Template->label = $this->objWidget->slabel;

		$this->addGroupCssClass('submit');

		if(!in_array('btn', $this->arrCssClasses))
		{
			$this->arrCssClasses[] = 'btn';
			$this->arrCssClasses[] = 'btn-default';
		}
	}
}