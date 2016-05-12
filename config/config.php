<?php

/**
 * Bootstrap Form Fields
 */

define('BOOTSTRAPPER_JS_COMPONENT_DIR', 'system/modules/bootstrapper/assets/js/components');

/**
 * Asset Components
 */
$GLOBALS['BOOTSTRAPPER_ASSET_COMPONENTS'] = array
(
	'bs.datetimepicker' =>  array
	(
		'js' => array
		(
			'system/modules/bootstrapper/assets/vendor/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') .  '.js|static',
			BOOTSTRAPPER_JS_COMPONENT_DIR . '/datetimepicker/bs.datetimepicker' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
		),
		'css' => array
		(
			'system/modules/bootstrapper/assets/vendor/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.css|screen|static|4.0.0'
		),
	),
);

/**
 * Boostrapper Widgets
 */
$GLOBALS['TL_FFL_BOOTSTRAPPER'] = array
(
	'legacy'          => 'HeimrichHannot\Bootstrapper\BootstrapperFormLegacy',
	'checkbox'        => 'HeimrichHannot\Bootstrapper\BootstrapperFormCheckBox',
	'radio'           => 'HeimrichHannot\Bootstrapper\BootstrapperFormRadio',
	'select'          => 'HeimrichHannot\Bootstrapper\BootstrapperFormSelect',
	'upload'          => 'HeimrichHannot\Bootstrapper\BootstrapperFormFileUpload',
	'text'            => 'HeimrichHannot\Bootstrapper\BootstrapperFormTextField',
	'textarea'        => 'HeimrichHannot\Bootstrapper\BootstrapperFormTextArea',
	'password'        => 'HeimrichHannot\Bootstrapper\BootstrapperFormPassword',
	'submit'          => 'HeimrichHannot\Bootstrapper\BootstrapperFormSubmit',
	'confirmed_email' => 'HeimrichHannot\Bootstrapper\BootstrapperFormConfirmedEmail'
);

/**
 * Front end form fields
 */
$GLOBALS['TL_FFL']['slider']       = 'HeimrichHannot\Bootstrapper\FormSlider';
$GLOBALS['TL_FFL']['submit']       = 'HeimrichHannot\FormButtonSubmit';
$GLOBALS['TL_FFL']['successGroup'] = 'HeimrichHannot\FormSuccessGroup';

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['news']['newsreader']      = 'HeimrichHannot\ModuleNewsReader';
$GLOBALS['FE_MOD']['newsletter']['subscribe'] = 'HeimrichHannot\AjaxContent\ModuleAjaxSubscribe';

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['texts']['tabcontrol'] = 'ContentTabControl';

/**
 * HOOKS
 */
$GLOBALS['TL_HOOKS']['parseWidget'][]              = array('HeimrichHannot\BootstrapperHooks', 'parseWidgetHook');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]        = array('HeimrichHannot\BootstrapperHooks', 'replaceInsertTagsHooks');
$GLOBALS['TL_HOOKS']['processFormData'][]          = array('HeimrichHannot\BootstrapperHooks', 'processFormDataHook');
$GLOBALS['TL_HOOKS']['compileFormFields'][]        = array('HeimrichHannot\BootstrapperHooks', 'compileFormFieldsHook');

if(is_array($GLOBALS['TL_HOOKS']['replaceDynamicScriptTags']))
{
	array_insert($GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'], 0, array(array('HeimrichHannot\BootstrapperHooks', 'hookReplaceDynamicScriptTagsHook')));
}
else
{
	$GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'][] = array('HeimrichHannot\BootstrapperHooks', 'hookReplaceDynamicScriptTagsHook');
}

/**
 * CSS
 */
$GLOBALS['TL_USER_CSS']['jasny-bootstrap']      =
	'system/modules/bootstrapper/assets/vendor/jasny-bootstrap/less/jasny-bootstrap.less|screen|static|3.1.3';
$GLOBALS['TL_USER_CSS']['contao-bootstrap']     = 'system/modules/bootstrapper/assets/css/contao.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['form-bootstrap']       = 'system/modules/bootstrapper/assets/css/form.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['pagination-bootstrap'] = 'system/modules/bootstrapper/assets/css/pagination.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['maps-bootstrap']       = 'system/modules/bootstrapper/assets/css/maps.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['carousel-bootstrap']   = 'system/modules/bootstrapper/assets/css/carousel.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['colorbox-bootstrap']   = 'system/modules/bootstrapper/assets/css/colorbox.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['bootstrap-slider']     =
	'system/modules/bootstrapper/assets/vendor/bootstrap-slider/less/bootstrap-slider.less|screen|static|3.0.0';
$GLOBALS['TL_USER_CSS']['animate']              = 'system/modules/bootstrapper/assets/vendor/animate/animate.min.css|screen|static';
/**
 * JS
 */
if (TL_MODE == 'FE') {

	$GLOBALS['TL_JAVASCRIPT']['fastclick'] =
		'/system/modules/bootstrapper/assets/vendor/fastclick-1.0.3/lib/fastclick' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '')
		. '.js|static';

	// bootstrap-datetimepicker
	$GLOBALS['TL_JAVASCRIPT']['moment']         =
		'system/modules/bootstrapper/assets/vendor/moment/min/moment-with-locales' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '')
		. '.js|static';

	$GLOBALS['TL_JAVASCRIPT']['numeral']         =
		'system/modules/bootstrapper/assets/vendor/numeral/min/numeral' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '')
		. '.js|static';

	$GLOBALS['TL_JAVASCRIPT']['numeral-languages']         =
		'system/modules/bootstrapper/assets/vendor/numeral/min/languages' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '')
		. '.js|static';

	// bootstrap gallery gesture/touch support
	$GLOBALS['TL_JAVASCRIPT']['jquery-validation']        = 'system/modules/bootstrapper/assets/vendor/validation/jquery.validate.min.js|static';
	$GLOBALS['TL_JAVASCRIPT']['jquery-validation-locale'] = 'system/modules/bootstrapper/assets/vendor/validation/methods_de.min.js|static';
	$GLOBALS['TL_JAVASCRIPT']['jquery-validation-locale'] = 'system/modules/bootstrapper/assets/vendor/validation/messages_de.min.js|static';

	$GLOBALS['TL_JAVASCRIPT']['jquery-placeholder'] =
		'system/modules/bootstrapper/assets/vendor/jquery.placeholder' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

	$GLOBALS['TL_JAVASCRIPT']['bootstrap-hover-dropdown'] =
		'system/modules/bootstrapper/assets/vendor/bootstrap-hover-dropdown-master/bootstrap-hover-dropdown'
		. (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

	$GLOBALS['TL_JAVASCRIPT']['bootstrap-slider'] = 'system/modules/bootstrapper/assets/vendor/bootstrap-slider/dist/bootstrap-slider.min.js|static';

	$GLOBALS['TL_JAVASCRIPT']['jquery.actual'] =
		'system/modules/bootstrapper/assets/vendor/jquery.actual/jquery.actual' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

	// needs to be after vendor libs
	$GLOBALS['TL_JAVASCRIPT']['bootstrapper-widgets'] =
		'system/modules/bootstrapper/assets/js/jquery.bootstrapper-widgets' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

	$GLOBALS['TL_JAVASCRIPT']['bootstrapper'] =
		'system/modules/bootstrapper/assets/js/jquery.bootstrapper' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

	// load jasny last, otherwise modal for example will not open
	$GLOBALS['TL_JAVASCRIPT']['jasny-bootstrap'] =
		'system/modules/bootstrapper/assets/vendor/jasny-bootstrap/dist/js/jasny-bootstrap' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '')
		. '.js|static';

	$GLOBALS['TL_JAVASCRIPT']['bootbox'] = 'system/modules/bootstrapper/assets/vendor/bootbox-4.4.0/bootbox.min.js|static';
}