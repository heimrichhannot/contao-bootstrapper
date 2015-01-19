<?php

$dc = &$GLOBALS['TL_DCA']['tl_form'];

$dc['palettes']['__selector__'][]= 'isAjaxForm';
$dc['palettes']['default'] = str_replace('formID','formID;{ajax_legend},isAjaxForm',$dc['palettes']['default']);
$dc['subpalettes']['isAjaxForm'] = 'ajaxFormSuccessContent';

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
	'ajaxFormSuccessContent' => array
	(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['ajaxFormSuccessContent'],
		'inputType'               => 'textarea',
		'eval'                    => array('mandatory'=>true, 'allowHtml'=>true, 'class'=>'monospace', 'rte'=>'ace|html', 'helpwizard'=>true),
		'explanation'             => 'insertTags',
		'sql'                     => "mediumtext NULL"
	)
);

$dc['fields'] = array_merge($dc['fields'], $arrFields);