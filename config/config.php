<?php

/**
 * Front end form fields
 */
$GLOBALS['TL_FFL']['submit'] = '\HeimrichHannot\FormButtonSubmit';

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['news']['newsreader'] = '\HeimrichHannot\ModuleNewsReader';

/**
 * HOOKS
 */
$GLOBALS['TL_HOOKS']['parseWidget'][]       = array('\HeimrichHannot\BootstrapperHooks', 'parseWidgetHook');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('HeimrichHannot\BootstrapperHooks', 'replaceInsertTagsHooks');

/**
 * CSS
 */
$GLOBALS['TL_USER_CSS']['contao-bootstrap']     = 'system/modules/bootstrapper/assets/css/contao.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['form-bootstrap']       = 'system/modules/bootstrapper/assets/css/form.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['pagination-bootstrap'] = 'system/modules/bootstrapper/assets/css/pagination.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['maps-bootstrap']       = 'system/modules/bootstrapper/assets/css/maps.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['carousel-bootstrap']   = 'system/modules/bootstrapper/assets/css/carousel.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['colorbox-bootstrap']   = 'system/modules/bootstrapper/assets/css/colorbox.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['chosen-bootstrap']     = 'system/modules/bootstrapper/assets/vendor/bootstrap-chosen/bootstrap-chosen.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['datetimepicker']       = 'system/modules/bootstrapper/assets/vendor/datetimepicker/jquery.datetimepicker.css|screen|static|2.3.4';
$GLOBALS['TL_USER_CSS']['bootstrap-slider']     = 'system/modules/bootstrapper/assets/vendor/bootstrap-slider/less/bootstrap-slider.less|screen|static|3.0.0';
$GLOBALS['TL_USER_CSS']['select2']              = 'system/modules/bootstrapper/assets/vendor/select2/select2.css|screen|static|3.5.1';
$GLOBALS['TL_USER_CSS']['selectize.js']           = 'system/modules/bootstrapper/assets/vendor/selectize.js/dist/less/selectize.less|screen|static|0.11.2';
$GLOBALS['TL_USER_CSS']['selectize.js-bootstrap'] = 'system/modules/bootstrapper/assets/vendor/selectize.js/dist/less/selectize.bootstrap3.less|screen|static|0.11.2';
$GLOBALS['TL_USER_CSS']['animate']              = 'system/modules/bootstrapper/assets/vendor/animate/animate.min.css|screen|static';

/**
 * JS
 */
if (TL_MODE == 'FE') {
	$GLOBALS['TL_JAVASCRIPT']['fastclick'] = '/system/modules/bootstrapper/assets/vendor/fastclick-1.0.3/lib/fastclick.js|static';

	$GLOBALS['TL_JAVASCRIPT']['chosen'] = 'system/modules/bootstrapper/assets/vendor/chosen/chosen.jquery.js|static';

	// bootstrap-datetimepicker
	$GLOBALS['TL_JAVASCRIPT']['moment']         = 'system/modules/bootstrapper/assets/vendor/moment/min/moment-with-locales.min.js|static';
	$GLOBALS['TL_JAVASCRIPT']['datetimepicker'] = 'system/modules/bootstrapper/assets/vendor/datetimepicker/jquery.datetimepicker.js|static';
	//$GLOBALS['TL_JAVASCRIPT']['eonasdan-bootstrap-datetimepicker-de']	= 'system/modules/bootstrapper/assets/vendor/eonasdan-bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.de.js';

	// bootstrap gallery gesture/touch support
	//$GLOBALS['TL_JAVASCRIPT']['bootstrap-touch-carousel']							= 'system/modules/bootstrapper/assets/vendor/bootstrap-touch-carousel/dist/js/bootstrap-touch-carousel.js';

	$GLOBALS['TL_JAVASCRIPT']['jquery-validation']        = 'system/modules/bootstrapper/assets/vendor/validation/jquery.validate.min.js|static';
	$GLOBALS['TL_JAVASCRIPT']['jquery-validation-locale'] = 'system/modules/bootstrapper/assets/vendor/validation/methods_de.min.js|static';
	$GLOBALS['TL_JAVASCRIPT']['jquery-validation-locale'] = 'system/modules/bootstrapper/assets/vendor/validation/messages_de.min.js|static';

	$GLOBALS['TL_JAVASCRIPT']['jquery-placeholder'] = 'system/modules/bootstrapper/assets/vendor/jquery.placeholder.js|static';

	$GLOBALS['TL_JAVASCRIPT']['bootstrap-hover-dropdown'] = 'system/modules/bootstrapper/assets/vendor/bootstrap-hover-dropdown-master/bootstrap-hover-dropdown.js|static';

	$GLOBALS['TL_JAVASCRIPT']['bootstrap-slider'] = 'system/modules/bootstrapper/assets/vendor/bootstrap-slider/js/bootstrap-slider.js|static';

//	$GLOBALS['TL_JAVASCRIPT']['select2']    = 'system/modules/bootstrapper/assets/vendor/select2/select2.js|static';
//	$GLOBALS['TL_JAVASCRIPT']['select2.de'] = 'system/modules/bootstrapper/assets/vendor/select2/select2_locale_de.js|static';

	$GLOBALS['TL_JAVASCRIPT']['selectize.js'] = 'system/modules/bootstrapper/assets/vendor/selectize.js/dist/js/standalone/selectize.js|static';

	$GLOBALS['TL_JAVASCRIPT']['jquery.actual'] = 'system/modules/bootstrapper/assets/vendor/jquery.actual/jquery.actual.js|static';

	// needs to be after vendor libs
	$GLOBALS['TL_JAVASCRIPT']['bootstrapper'] = 'system/modules/bootstrapper/assets/js/jquery.bootstrapper.js|static';
}