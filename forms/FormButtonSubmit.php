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
		return sprintf('<button type="submit" id="ctrl_%s" class="submit%s"%s%s%s</button>',
						$this->strId,
						(($this->strClass != '') ? ' ' . $this->strClass : ''),
						$this->getAttributes(),
						$this->strTagEnding,
						specialchars($this->slabel)
						);
	}
}
