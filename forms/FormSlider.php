<?php
/**
 * Contao Open Source CMS
 * 
 * Copyright (c) 2016 Heimrich & Hannot GmbH
 * @package AVV
 * @author Oliver Janke <o.janke@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\Bootstrapper;


class FormSlider extends \Widget
{
	/**
	 * Template
	 *
	 * @var string
	 */
	protected $strTemplate = 'form_slider';

	/**
	 * Generate the widget and return it as string
	 *
	 * @return string The widget markup
	 */
	public function generate()
	{
		$arrAttributes = array();
		$arrConfig = $this->arrConfiguration;
		$arrSliderConfig = $arrConfig['slider'];

		$arrAttributes['strId'] = $this->strId;
		$arrAttributes['strName'] = $this->strName;

		foreach ($arrSliderConfig as $key => $varConfig)
		{
			if ($varConfig != null && $varConfig != '')
			{
				switch ($key)
				{
					case 'min_callback' :
						$arrSliderConfig['min'] = $this->getConfigValue($varConfig);
						break;
					case 'max_callback' :
						$arrSliderConfig['max'] = $this->getConfigValue($varConfig);
						break;
					case 'value_callback' :
						$arrSliderConfig['value'] = $this->getConfigValue($varConfig);
						break;
					case 'step_callback' :
						$arrSliderConfig['step'] = $this->getConfigValue($varConfig);
						break;
					default :
						break;
				}
			}
			else
			{
				$arrSliderConfig[$key] = 0;
			}
		}

		$arrSliderConfig['id'] = 'slider-' . $arrAttributes['strId'];

		$this->Template = new \FrontendTemplate($this->strTemplate);
		$this->Template->setData($arrAttributes);
		$this->Template->slider = $arrSliderConfig;

		return $this->Template->parse();
	}

	private function getConfigValue($varValue)
	{
		if (is_array($varValue))
		{
			$this->import($varValue[0]);
			return $this->$varValue[0]->$varValue[1]($this->objDca);
		}
		elseif (is_callable($varValue))
		{
			return $varValue;
		}
		else
		{
			return 0;
		}
	}
}