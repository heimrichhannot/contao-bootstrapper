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


class BootstrapperButtonDropdown extends BootstrapperComponent
{
    protected $strTemplate = 'bootstrapper_button_dropdown';

    protected function compile()
    {
        $this->Template->btnClass = 'btn' . ($this->arrParam[1] ? ' ' . $this->arrParam[1] : '');
        $this->Template->btnText  = $this->arrParam[2];

        $this->Template->btnIsAnchor = false;

        // handle links inside text as anchor, not as button
        if (preg_match('#(<a\s+[^>]+>)#', $this->Template->btnText)) {
            $this->Template->btnIsAnchor = true;
            $this->Template->btnText     = preg_replace('#(^<a)#', '<a class="' . $this->Template->btnClass . '"', $this->Template->btnText);
        }


        $this->Template->links    = array_splice($this->arrParam, 3, count($this->arrParam));
        $this->Template->hasLinks = !empty($this->Template->links);
    }
}