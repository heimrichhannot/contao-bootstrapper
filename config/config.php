<?php


$GLOBALS['TL_HOOKS']['parseWidget'][] = array('Bootstrapper', 'parseWidgetHook');

$GLOBALS['TL_USER_CSS']['form-bootstrap'] = 'system/modules/bootstrapper/assets/css/form-bootstrap.less|screen|static|3.1.1';