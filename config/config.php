<?php

/**
 * Bootstrap Form Fields
 */

define('BOOTSTRAPPER_JS_COMPONENT_DIR', 'system/modules/bootstrapper/assets/js/components');

/**
 * Asset Components
 */
$GLOBALS['TL_COMPONENTS']['bs.datetimepicker'] = [
    'js'  => [
        'files' => [
            'system/modules/bootstrapper/assets/vendor/eonasdan-bootstrap-datetimepicker' . ($GLOBALS['TL_CONFIG']['debugMode'] ? '/src' : '/build')
            . '/js/bootstrap-datetimepicker' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
            BOOTSTRAPPER_JS_COMPONENT_DIR . '/datetimepicker/bs.datetimepicker' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
        ],
    ],
    'css' => [
        'files' => [
            'system/modules/bootstrapper/assets/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css|screen|static',
        ],
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.select'] = [
    'js'  => [
        'files' => [
            'system/modules/bootstrapper/assets/vendor/bootstrap-select/dist/js/bootstrap-select'
            . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
            BOOTSTRAPPER_JS_COMPONENT_DIR . '/select/bs.select.i18n' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
            BOOTSTRAPPER_JS_COMPONENT_DIR . '/select/bs.select' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
        ],
    ],
    'css' => [
        'files' => [
            'system/modules/bootstrapper/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css|screen|static',
        ],
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.inputSlider'] = [
    'js'  => [
        'files' => [
            'system/modules/bootstrapper/assets/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider'
            . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
            BOOTSTRAPPER_JS_COMPONENT_DIR . '/input-slider/bs.inputSlider' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
        ],
    ],
    'css' => [
        'files' => [
            'system/modules/bootstrapper/assets/vendor/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css|screen|static',
        ],
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.tooltip'] = [
    'js' => [
        'files' => [
            BOOTSTRAPPER_JS_COMPONENT_DIR . '/tooltip/bs.tooltip' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
        ],
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.scrollSmooth'] = [
    'js' => [
        'files' => [
            BOOTSTRAPPER_JS_COMPONENT_DIR . '/scroll-smooth/bs.scroll-smooth' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
        ],
    ],
];

$GLOBALS['TL_COMPONENTS']['modernizr'] = [
    'js' => [
        'files' => [
            'system/modules/bootstrapper/assets/vendor/modernizr.min.js|static',
        ],
        'sort'  => 0,
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.awesomeInputs'] = [
    'css' => [
        'files' => [
            'system/modules/bootstrapper/assets/vendor/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css|screen|static'
        ],
    ],
];

/**
 * Boostrapper Widgets
 */
$GLOBALS['TL_FFL_BOOTSTRAPPER'] = [
    'legacy'          => 'HeimrichHannot\Bootstrapper\BootstrapperFormLegacy',
    'checkbox'        => 'HeimrichHannot\Bootstrapper\BootstrapperFormCheckBox',
    'radio'           => 'HeimrichHannot\Bootstrapper\BootstrapperFormRadio',
    'select'          => 'HeimrichHannot\Bootstrapper\BootstrapperFormSelect',
    'upload'          => 'HeimrichHannot\Bootstrapper\BootstrapperFormFileUpload',
    'text'            => 'HeimrichHannot\Bootstrapper\BootstrapperFormTextField',
    'textarea'        => 'HeimrichHannot\Bootstrapper\BootstrapperFormTextArea',
    'password'        => 'HeimrichHannot\Bootstrapper\BootstrapperFormPassword',
    'submit'          => 'HeimrichHannot\Bootstrapper\BootstrapperFormSubmit',
    'confirmed_email' => 'HeimrichHannot\Bootstrapper\BootstrapperFormConfirmedEmail',
];

/**
 * Front end form fields
 */
$GLOBALS['TL_FFL']['slider']       = 'HeimrichHannot\Bootstrapper\FormSlider';
$GLOBALS['TL_FFL']['submit']       = 'HeimrichHannot\FormButtonSubmit';
$GLOBALS['TL_FFL']['successGroup'] = 'HeimrichHannot\FormSuccessGroup';

/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['newsletter']['subscribe'] = 'HeimrichHannot\AjaxContent\ModuleAjaxSubscribe';

/**
 * Content elements
 */
$GLOBALS['TL_CTE']['texts']['tabcontrol'] = 'ContentTabControl';

/**
 * HOOKS
 */
$GLOBALS['TL_HOOKS']['parseWidget'][]       = ['HeimrichHannot\BootstrapperHooks', 'parseWidgetHook'];
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = ['HeimrichHannot\BootstrapperHooks', 'replaceInsertTagsHooks'];
$GLOBALS['TL_HOOKS']['processFormData'][]   = ['HeimrichHannot\BootstrapperHooks', 'processFormDataHook'];
$GLOBALS['TL_HOOKS']['compileFormFields'][] = ['HeimrichHannot\BootstrapperHooks', 'compileFormFieldsHook'];

if (is_array($GLOBALS['TL_HOOKS']['replaceDynamicScriptTags']))
{
    array_insert($GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'], 0, [['HeimrichHannot\BootstrapperHooks', 'hookReplaceDynamicScriptTagsHook']]);
}
else
{
    $GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'][] = ['HeimrichHannot\BootstrapperHooks', 'hookReplaceDynamicScriptTagsHook'];
}

/**
 * CSS
 */
// currently no bs4 support
//$GLOBALS['TL_USER_CSS']['jasny-bootstrap']  = 'system/modules/bootstrapper/assets/vendor/jasny-bootstrap/less/jasny-bootstrap.less|screen|static|3.1.3';

$GLOBALS['TL_USER_CSS']['animate'] = 'system/modules/bootstrapper/assets/vendor/animate/animate.min.css|screen|static';

/**
 * JS
 */
if (TL_MODE == 'FE')
{

    $GLOBALS['TL_JAVASCRIPT']['fastclick'] = '/system/modules/bootstrapper/assets/vendor/fastclick/lib/fastclick.js|static';

    // bootstrap-datetimepicker
    $GLOBALS['TL_JAVASCRIPT']['moment'] =
        'system/modules/bootstrapper/assets/vendor/moment/min/moment-with-locales' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '')
        . '.js|static';

    $GLOBALS['TL_JAVASCRIPT']['numeral'] =
        'system/modules/bootstrapper/assets/vendor/numeral' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '/min' : '') . '/numeral'
        . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

    $GLOBALS['TL_JAVASCRIPT']['numeral-languages'] =
        'system/modules/bootstrapper/assets/vendor/numeral' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '/min' : '') . '/languages'
        . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

    // bootstrap gallery gesture/touch support
    $GLOBALS['TL_JAVASCRIPT']['jquery-validation']        = 'system/modules/bootstrapper/assets/vendor/validation/jquery.validate.min.js|static';
    $GLOBALS['TL_JAVASCRIPT']['jquery-validation-locale'] = 'system/modules/bootstrapper/assets/vendor/validation/methods_de.min.js|static';
    $GLOBALS['TL_JAVASCRIPT']['jquery-validation-locale'] = 'system/modules/bootstrapper/assets/vendor/validation/messages_de.min.js|static';

    $GLOBALS['TL_JAVASCRIPT']['jquery-placeholder'] =
        'system/modules/bootstrapper/assets/vendor/jquery.placeholder' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

    $GLOBALS['TL_JAVASCRIPT']['bootstrap-hover-dropdown'] =
        'system/modules/bootstrapper/assets/vendor/bootstrap-hover-dropdown-master/bootstrap-hover-dropdown'
        . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';


    $GLOBALS['TL_JAVASCRIPT']['jquery.actual'] =
        'system/modules/bootstrapper/assets/vendor/jquery.actual/jquery.actual' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

    // needs to be after vendor libs
    $GLOBALS['TL_JAVASCRIPT']['bootstrapper-widgets'] =
        'system/modules/bootstrapper/assets/js/jquery.bootstrapper-widgets' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

    $GLOBALS['TL_JAVASCRIPT']['bootstrapper'] =
        'system/modules/bootstrapper/assets/js/jquery.bootstrapper' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

    // load jasny last, otherwise modal for example will not open
//    $GLOBALS['TL_JAVASCRIPT']['jasny-bootstrap'] =
//        'system/modules/bootstrapper/assets/vendor/jasny-bootstrap/dist/js/jasny-bootstrap' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static';

    $GLOBALS['TL_JAVASCRIPT']['bootbox'] = 'system/modules/bootstrapper/assets/vendor/bootbox.js/bootbox.js|static';
}