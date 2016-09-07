<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2016 Heimrich & Hannot GmbH
 *
 * @package AVV
 * @author  Oliver Janke <o.janke@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */


namespace HeimrichHannot\Bootstrapper;


class FormSlider extends \Widget
{
	/**
	 * Submit user input
	 *
	 * @var boolean
	 */
	protected $blnSubmitInput = true;

	/**
	 * Add a for attribute
	 *
	 * @var boolean
	 */
	protected $blnForAttribute = true;

	/**
	 * Template
	 *
	 * @var string
	 */
	protected $strTemplate = 'form_slider';

	/**
	 * Slider configuration
	 *
	 * @var array
	 */
	protected $arrSliderConfig = array();

	protected $minRangeLabel = null;

	protected $maxRangeLabel = null;

	protected $submitInput = true;

	public function __construct($arrAttributes = null)
	{
		parent::__construct($arrAttributes);

		$this->arrSliderConfig = $this->slider;

		$arrSliderConfig = $this->getSliderConfig($this->arrSliderConfig);

		foreach ($arrSliderConfig as $key => $value) {
			if (empty($value)) {
				continue;
			}

			$key = str_replace('_', '-', $key);

			$this->addAttribute('data-slider-' . $key, is_array($value) ? json_encode($value, JSON_NUMERIC_CHECK) : $value);
		}
	}

	/**
	 * Generate the widget and return it as string
	 *
	 * @return string The widget markup
	 */
	public function generate()
	{
		return sprintf(
				   '%s<input type="%s" name="%s" id="ctrl_%s" class="bootstrap-slider text%s%s" value="%s"%s%s%s',
				   $this->minRangeLabel,
				   $this->type,
				   $this->strName,
				   $this->strId,
				   ($this->hideInput ? ' password' : ''),
				   (($this->strClass != '') ? ' ' . $this->strClass : ''),
				   specialchars($this->value),
				   $this->getAttributes(),
				   $this->strTagEnding,
				   $this->maxRangeLabel
			   ) . $this->addSubmit();
	}

	protected function getSliderConfig($arrConfig = array())
	{
		if (!is_array($arrConfig)) {
			$arrConfig = array();
		}

		$arrDefaults = array
		(
			// set the id of the slider element when it's created
			'id'                 => 'slider-' . $this->strName,
			// minimum possible value
			'min'                => 0,
			// maximum possible value
			'max'                => 10,
			// increment step
			'step'               => 1,
			// The number of digits shown after the decimal. Defaults to the number of digits after the decimal of step value.
			'precision'          => 0,
			// set the orientation. Accepts 'vertical' or 'horizontal'
			'orientation'        => 'horizontal',
			// initial value. Use array to have a range slider.
			'value'              => 5,
			// make range slider. Optional if initial value is an array. If initial value is scalar, max will be used for second value.
			'range'              => false,
			// selection placement. Accepts: 'before', 'after' or 'none'. In case of a range slider, the selection will be placed between the handles
			'selection'          => 'before',
			// whether to show the tooltip on drag, hide the tooltip, or always show the tooltip. Accepts: 'show', 'hide', or 'always'
			'tooltip'            => 'show',
			//if false show one tootip if true show two tooltips one for each handler
			'tooltip_split'      => false,
			// handle shape. Accepts: 'round', 'square', 'triangle' or 'custom'
			'handle'             => 'round',
			// whether or not the slider should be reversed
			'reversed'           => false,
			// whether or not the slider is initially enabled
			'enabled'            => true,
			// The natural order is used for the arrow keys. Arrow up select the upper slider value for vertical sliders, arrow right the righter slider value for a horizontal slider - no matter if the slider was reversed or not. By default the arrow keys are oriented by arrow up/right to the higher slider value, arrow down/left to the lower slider value.
			'natural_arrow_keys' => false,
			// Used to define the values of ticks. Tick marks are indicators to denote special values in the range. This option overwrites min and max options.
			'ticks'              => array(),
			// Defines the positions of the tick values in percentages. The first value should always be 0, the last value should always be 100 percent.
			'ticks_positions'    => array(),
			// Defines the labels below the tick marks. Accepts HTML input.
			'ticks_labels'       => array(),
			// Used to define the snap bounds of a tick. Snaps to the tick if value is within these bounds.
			'ticks_snap_bounds'  => 0,
			// Set to 'logarithmic' to use a logarithmic scale.
			'scale'              => 'linear',
			// Focus the appropriate slider handle after a value change.
			'focus'              => false,
			// ARIA labels for the slider handle's, Use array for multiple values in a range slider.
			'labelledby'         => null,
			// add min and max labels or set to null if you want to disable
			'rangeLabels'        => array
			(
				'min' => array
				(
					'mode' => 'sync', // min label, accepts 'sync' for sync with current range min value or false if you want to hide
					'prefix' => '',
					'suffix' => '',
				),
				'max' => array
				(
					'mode' => 'sync', // max label, accepts 'sync' for sync with current range min value or false if you want to hide
					'prefix' => '',
					'suffix' => '',
				),
			),
		);

		$arrConfig = array_merge($arrDefaults, $arrConfig);

		$min = $arrConfig['min'];
		$max = $arrConfig['max'];

		if($this->varValue)
		{
			$arrConfig['value'] = $this->varValue;
			$arrRange = trimsplit(',', $this->varValue);
			$max = $this->varValue;

			if(is_array($arrRange) && count($arrRange) > 1)
			{
				if($arrConfig['range'] == true)
				{
					$arrConfig['value'] = $arrRange;
					$min = $arrRange[0];
					$max = $arrRange[1];
				}
				else {
					$max = $arrRange[1];
					$arrConfig['value'] = $arrRange[1];
				}
			}
		}

		foreach ($arrConfig as $key => $varValue) {
			switch ($key) {
				case 'min_callback' :
					$arrConfig['min'] = $this->getConfigValue($varValue);
					break;
				case 'max_callback' :
					$arrConfig['max'] = $this->getConfigValue($varValue);
					break;
				case 'value_callback' :
					$arrConfig['value'] = $this->getConfigValue($varValue);
					break;
				case 'step_callback' :
					$arrConfig['step'] = $this->getConfigValue($varValue);
					break;
				case 'rangeLabels':
					if (!is_array($arrConfig['rangeLabels'])) {
						unset($arrConfig['rangeLabels']);
						break;
					}

					if (isset($arrConfig['rangeLabels']['min'])) {
						$this->minRangeLabel           = sprintf(
							'<span id="%s" class="slider-label-from"%s>%s<span class="value">%s</span>%s</span>',
							$arrConfig['id'] . '-label-from',
							$arrConfig['rangeLabels']['min']['mode'] == 'sync' ? ' data-sync="true"' : '',
							$arrConfig['rangeLabels']['min']['prefix'] ? ('<span class="prefix">' . $arrConfig['rangeLabels']['min']['prefix'] . '</span>') : '',
							$min,
							$arrConfig['rangeLabels']['min']['suffix'] ? ('<span class="suffix">' . $arrConfig['rangeLabels']['min']['suffix'] . '</span>') : ''
						);
						$arrConfig['range-label-from'] = '#' .  $arrConfig['id'] . '-label-from';
					}

					if (isset($arrConfig['rangeLabels']['max'])) {
						$this->maxRangeLabel         = sprintf(
							'<span id="%s" class="slider-label-to"%s>%s<span class="value">%s</span>%s</span>',
							$arrConfig['id'] . '-label-to',
							$arrConfig['rangeLabels']['max']['mode'] == 'sync' ? ' data-sync="true"' : '',
							$arrConfig['rangeLabels']['max']['prefix'] ? ('<span class="prefix">' . $arrConfig['rangeLabels']['max']['prefix'] . '</span>') : '',
							$max,
							$arrConfig['rangeLabels']['max']['suffix'] ? ('<span class="suffix">' . $arrConfig['rangeLabels']['max']['suffix'] . '</span>') : ''
						);
						$arrConfig['range-label-to'] = '#' . $arrConfig['id'] . '-label-to';
					}

					unset($arrConfig['rangeLabels']);

					break;
				default :
					$arrConfig[$key] = $varValue;
					break;
			}
		}

		return $arrConfig;
	}

	private function getConfigValue($varValue)
	{
		if (is_array($varValue)) {
			$this->import($varValue[0]);

			return $this->$varValue[0]->$varValue[1]($this->objDca, $this->arrSliderConfig);
		} elseif (is_callable($varValue)) {
			return $varValue;
		} else {
			return 0;
		}
	}
}