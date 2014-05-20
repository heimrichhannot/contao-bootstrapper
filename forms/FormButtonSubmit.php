<?php

namespace HeimrichHannot;

class FormButtonSubmit extends \FormSubmit
{
	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate()
	{
		if ($this->imageSubmit && $this->singleSRC != '')
		{
			parent::generate();
		}

		// Return the regular button as button not input
		return sprintf('<button type="submit"%s class="submit%s"%s%s<span class="before"></span><span>%s</span><span class="after"></span></button>',
						$this->strId ? 'id="ctrl_' . $this->strId : '',
						(($this->strClass != '') ? ' ' . $this->strClass : ''),
						$this->getAttributes(),
						$this->strTagEnding,
						specialchars($this->slabel)
						);
	}
}
