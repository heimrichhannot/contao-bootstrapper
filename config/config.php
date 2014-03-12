<?php


$GLOBALS['TL_HOOKS']['parseWidget'][] = array('Bootstrapper', 'parseWidgetHook');

$GLOBALS['TL_USER_CSS']['form-bootstrap'] = 'system/modules/bootstrapper/assets/css/form.less|screen|static|3.1.1';
$GLOBALS['TL_USER_CSS']['form-bootstrap'] = 'system/modules/bootstrapper/assets/css/pagination.less|screen|static|3.1.1';