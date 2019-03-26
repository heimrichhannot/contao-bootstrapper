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

/**
 * Class BootstrapperFormLegacy
 *
 * @package HeimrichHannot\Bootstrapper
 * @deprecated create a custom class extending BootstrapperFormField for each inputType
 */
class BootstrapperFormLegacy extends BootstrapperFormField
{
    protected $strTemplate = 'bootstrapper_form';

    protected function compile()
    {

    }
}