<?php


$GLOBALS['TL_HOOKS']['parseWidget'][] = array('Bootstrapper', 'parseWidgetHook');

$GLOBALS['TL_USER_CSS']['form-bootstrap'] = 'system/modules/bootstrapper/assets/css/form.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['pagination-bootstrap'] = 'system/modules/bootstrapper/assets/css/pagination.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['maps-bootstrap'] = 'system/modules/bootstrapper/assets/css/maps.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['colorbox-bootstrap'] = 'system/modules/bootstrapper/assets/css/colorbox.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['chosen-bootstrap'] = 'system/modules/bootstrapper/assets/vendor/bootstrap-chosen/bootstrap-chosen.less|screen|static|3.1.1';

if(TL_MODE == 'FE')
{
	$GLOBALS['TL_JAVASCRIPT']['chosen'] = 'system/modules/bootstrapper/assets/vendor/chosen/chosen.jquery.js|static';
	$GLOBALS['TL_JAVASCRIPT']['bootstrapper'] = 'system/modules/bootstrapper/assets/js/jquery.bootstrapper.js|static';
}