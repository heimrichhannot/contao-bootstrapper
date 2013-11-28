<?php

$dc = &$GLOBALS['TL_DCA']['tl_form_field'];

/**
 * Palettes
 */
foreach($dc['palettes'] as $key => $palette)
{
	if(in_array($key, array('__selector__', 'fieldset'))) continue;

	// add bootstrapper form-group class to all palettes
	$dc['palettes'][$key] = str_replace('class', 'class, groupClass', $palette);

}

/**
 * Fields
 */
$arrFields = array
(
		'groupClass' => array
		(
				'label'                   => &$GLOBALS['TL_LANG']['tl_form_field']['groupClass'],
				'exclude'                 => true,
				'search'                  => true,
				'inputType'               => 'text',
				'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
				'sql'                     => "varchar(255) NOT NULL default ''"
		),
);

$dc['fields'] = array_merge($dc['fields'], $arrFields);