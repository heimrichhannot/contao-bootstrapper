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
$GLOBALS['TL_HOOKS']['parseWidget'][] = array('Bootstrapper', 'parseWidgetHook');

/**
 * CSS
 */
$GLOBALS['TL_USER_CSS']['contao-bootstrap'] = 'system/modules/bootstrapper/assets/css/contao.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['form-bootstrap'] = 'system/modules/bootstrapper/assets/css/form.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['pagination-bootstrap'] = 'system/modules/bootstrapper/assets/css/pagination.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['maps-bootstrap'] = 'system/modules/bootstrapper/assets/css/maps.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['carousel-bootstrap'] = 'system/modules/bootstrapper/assets/css/carousel.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['colorbox-bootstrap'] = 'system/modules/bootstrapper/assets/css/colorbox.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['chosen-bootstrap'] = 'system/modules/bootstrapper/assets/vendor/bootstrap-chosen/bootstrap-chosen.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['eonasdan-bootstrap-datetimepicker']		= 'system/modules/bootstrapper/assets/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css|screen|static|2.1.20';
$GLOBALS['TL_USER_CSS']['elastislide'] = 'system/modules/bootstrapper/assets/vendor/elastislide-responsive-carousel/css/elastislide.css|screen|static|1.1.0';

//$GLOBALS['TL_USER_CSS']['bootstrap-touch-carousel']							= 'system/modules/bootstrapper/assets/vendor/bootstrap-touch-carousel/dist/css/bootstrap-touch-carousel.css';
/**
 * JS
 */
if(TL_MODE == 'FE')
{
	$GLOBALS['TL_JAVASCRIPT']['chosen'] = 'system/modules/bootstrapper/assets/vendor/chosen/chosen.jquery.js';
	
	// bootstrap-datetimepicker
	$GLOBALS['TL_JAVASCRIPT']['moment']																= 'system/modules/bootstrapper/assets/vendor/moment/min/moment.min.js|static';
	$GLOBALS['TL_JAVASCRIPT']['eonasdan-bootstrap-datetimepicker']		= 'system/modules/bootstrapper/assets/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js';
	$GLOBALS['TL_JAVASCRIPT']['eonasdan-bootstrap-datetimepicker-de']	= 'system/modules/bootstrapper/assets/vendor/eonasdan-bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.de.js';
	
	// codrops elastislide
	$GLOBALS['TL_JAVASCRIPT']['elastislide'] = 'system/modules/bootstrapper/assets/vendor/elastislide-responsive-carousel/js/jquery.elastislide.js|1.1.0';
	
	// bootstrap gallery gesture/touch support
	//$GLOBALS['TL_JAVASCRIPT']['bootstrap-touch-carousel']							= 'system/modules/bootstrapper/assets/vendor/bootstrap-touch-carousel/dist/js/bootstrap-touch-carousel.js';
	
	$GLOBALS['TL_JAVASCRIPT']['jquery-placeholder'] = 'system/modules/bootstrapper/assets/vendor/jquery.placeholder.js';
	
	// needs to be after vendor libs
	$GLOBALS['TL_JAVASCRIPT']['bootstrapper'] = 'system/modules/bootstrapper/assets/js/jquery.bootstrapper.js';
}