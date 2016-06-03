<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_settings'];

/*
 * Palettes
 */
$arrDca['palettes']['default'] .= ';{bootstrapper_legend},useAwesomeInputs;';

/**
 * Fields
 */
$arrFields = array(
	'useAwesomeInputs' => array(
		'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['useAwesomeInputs'],
		'exclude'                 => true,
		'inputType'               => 'checkbox',
		'eval'                    => array('tl_class' => 'w50')
	)
);

$arrDca['fields'] = array_merge($arrFields, $arrDca['fields']);