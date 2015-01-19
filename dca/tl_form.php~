<?php

$dc = &$GLOBALS['TL_DCA']['tl_form'];

$dc['palettes']['__selector__'][]= 'isAjaxForm';
$dc['palettes']['default'] = str_replace('formID','formID;{ajax_legend},isAjaxForm',$dc['palettes']['default']);
$dc['subpalettes']['isAjaxForm'] = 'hideFormOnSuccess';

$arrFields = array
(
	'isAjaxForm' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['isAjaxForm'],
		'exclude'                 => true,
		'filter'                  => true,
		'inputType'               => 'checkbox',
		'eval'                    => array('submitOnChange'=>true),
		'sql'                     => "char(1) NOT NULL default ''"
	),
	'hideFormOnSuccess' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['hideFormOnSuccess'],
		'exclude'                 => true,
		'filter'                  => true,
		'default'				  => true,
		'inputType'               => 'checkbox',
		'sql'                     => "char(1) NOT NULL default ''"
	)
);

$dc['fields'] = array_merge($dc['fields'], $arrFields);
