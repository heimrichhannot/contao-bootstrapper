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

class BootstrapperFormCheckedEmail extends BootstrapperFormField
{
	protected $strTemplate = 'bootstrapper_form_checkedEmail';

	protected function compile()
	{
		$this->Template->addConfirmation = method_exists($this->objWidget, 'generateConfirmationLabel');

		if($this->Template->addConfirmation)
		{
			$this->Template->confirmationLabel = sprintf($GLOBALS['TL_LANG']['MSC']['CheckedEmailConfirmation'], $this->objWidget->label);

			$this->Template->confirmationGroupClass = str_replace($this->objWidget->id, $this->objWidget->id . '-confirm', $this->getGroupCssClasses());
		}
	}
}