<?php

$dc = &$GLOBALS['TL_DCA']['tl_form_field'];

$dc['palettes']['successGroup'] = '{type_legend},type;{fconfig_legend},successType,label;{expert_legend:hide},class;{template_legend:hide},customTpl';

/**
 * Palettes
 */
foreach ($dc['palettes'] as $key => $palette) {
    if (in_array($key, ['__selector__'])) {
        continue;
    }

    // add bootstrapper form-group class to all palettes
    $dc['palettes'][$key] = str_replace('class', 'class, groupClass', $palette);

}

/**
 * Fields
 */
$arrFields = [
    'groupClass'  => [
        'label'     => &$GLOBALS['TL_LANG']['tl_form_field']['groupClass'],
        'exclude'   => true,
        'search'    => true,
        'inputType' => 'text',
        'eval'      => ['maxlength' => 255, 'tl_class' => 'w50'],
        'sql'       => "varchar(255) NOT NULL default ''"
    ],
    'successType' => [
        'label'     => &$GLOBALS['TL_LANG']['tl_form_field']['successType'],
        'default'   => 'successStart',
        'exclude'   => true,
        'inputType' => 'radio',
        'options'   => ['successStart', 'successStop'],
        'reference' => &$GLOBALS['TL_LANG']['tl_form_field'],
        'eval'      => ['helpwizard' => true, 'submitOnChange' => true],
        'sql'       => "varchar(32) NOT NULL default ''"
    ]
];

$dc['fields'] = array_merge($dc['fields'], $arrFields);