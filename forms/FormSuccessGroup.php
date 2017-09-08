<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 * @package bootstrapper
 * @author Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot;


class FormSuccessGroup extends \Widget
{

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'form_successgroup';


    /**
     * Do not validate
     */
    public function validate()
    {
        return;
    }


    /**
     * Parse the template file and return it as string
     *
     * @param array $arrAttributes An optional attributes array
     *
     * @return string The template markup
     */
    public function parse($arrAttributes = null)
    {
        // Return a wildcard in the back end
        if (TL_MODE == 'BE') {
            $objTemplate = new \BackendTemplate('be_wildcard');

            if ($this->successType == 'successStart') {
                $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['tl_form_field']['successStart'][0]) . ' ###' . ($this->label ? '<br>' . $this->label : '');
            } else {
                $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['tl_form_field']['successStop'][0]) . ' ###';
            }

            return $objTemplate->parse();
        }

        // Only tableless forms are supported
        if (!$this->tableless) {
            return '';
        }

        return parent::parse($arrAttributes);
    }


    /**
     * Generate the widget and return it as string
     *
     * @return string The widget markup
     */
    public function generate()
    {
        // Only tableless forms are supported
        if (!$this->tableless) {
            return '';
        }

        if ($this->successType == 'successStart') {
            return "  <div" . ($this->strClass ? ' class="' . $this->strClass . '"' : '') . ">\n" . (($this->label != '') ? "  <legend>" . $this->label . "</legend>\n" : '');
        } else {
            return "  </div>\n";
        }
    }
} 