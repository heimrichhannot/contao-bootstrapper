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
            $this->Template->btnText     = preg_replace('#(^<a)#', '<a class="dropdown-item ' . $this->Template->btnClass . '"', $this->Template->btnText);
        }


        $links    = array_splice($this->arrParam, 3, count($this->arrParam));

        if (!empty($links)) {
            foreach ($links as $key => $link) {
                if(strpos($link, 'class=') !== false)
                {
                    $links[$key] = preg_replace('/class=["|\'](.*)/', '$1 dropdown-item$2', $link);
                }else{
                    $links[$key] = preg_replace('/(\<a)(.*)/', '$1 class="dropdown-item"$2', $link);
                }
            }
        }

        $this->Template->links = $links;
        $this->Template->hasLinks = !empty($links);
    }
}