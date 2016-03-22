<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2016 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

$dc = &$GLOBALS['TL_DCA']['tl_layout'];

/**
 * Selectors
 */
$dc['palettes']['__selector__'][] = 'bs_disable_components';

/**
 * Palettes
 */
$jsPalette                 = '{bootstrapper_legend},bs_disable_components;';
$dc['palettes']['default'] = str_replace('addJQuery;', 'addJQuery;' . $jsPalette, $dc['palettes']['default']);

/**
 * Subpalettes
 */
$dc['subpalettes']['bs_disable_components'] = 'bs_disabled_components';

/**
 * Fields
 */
$arrFields = array
(
	'bs_disable_components'             => array
	(
		'label'     => &$GLOBALS['TL_LANG']['tl_layout']['bs_disable_components'],
		'exclude'   => true,
		'filter'    => true,
		'inputType' => 'checkbox',
		'eval'      => array('submitOnChange' => true),
		'sql'       => "char(1) NOT NULL default ''",
	),
	'bs_disabled_components' => array
	(
		'label'            => &$GLOBALS['TL_LANG']['tl_layout']['bs_disabled_components'],
		'exclude'          => true,
		'inputType'        => 'checkboxWizard',
		'options_callback' => array('HeimrichHannot\Bootstrapper\Backend\Layout', 'getComponentsAsOption'),
		'eval'             => array('multiple' => true),
		'sql'              => "blob NULL",
	),
);

$dc['fields'] = array_merge($dc['fields'], $arrFields);