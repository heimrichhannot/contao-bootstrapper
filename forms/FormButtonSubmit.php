<?php

namespace HeimrichHannot;

class FormButtonSubmit extends \FormSubmit
{
    /**
     * Add specific attributes
     *
     * @param string $strKey The attribute name
     * @param mixed $varValue The attribute value
     */
    public function __set($strKey, $varValue)
    {
        switch ($strKey) {
            case 'name':
                $this->arrAttributes['name'] = $varValue;
                $this->strName               = $varValue;
                break;
            default:
                parent::__set($strKey, $varValue);
                break;
        }
    }

    /**
     * Generate the widget and return it as string
     * @return string
     */
    public function generate()
    {
        if ($this->imageSubmit && $this->singleSRC != '') {
            parent::generate();
        }

        // Return the regular button as button not input
        return sprintf('<button type="submit"%s%s%s class="submit%s"%s%s<span class="before"></span><span>%s</span><span class="after"></span></button>',
            $this->strId ? ' id="ctrl_' . $this->strId . '"' : '',
            $this->strName ? ' value="1"' : '',
            $this->strName ? ' name="' . $this->strName . '"' : '',
            (($this->strClass != '') ? ' ' . $this->strClass : ''),
            $this->getAttributes(),
            $this->strTagEnding,
            specialchars($this->slabel)
        );
    }
}

