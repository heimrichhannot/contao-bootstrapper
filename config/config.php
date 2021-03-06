<?php

/**
 * Bootstrap Form Fields
 */

define('BOOTSTRAPPER_JS_COMPONENT_DIR', 'system/modules/bootstrapper/assets/js/components');

$GLOBALS['TL_COMPONENTS']['bs.core'] = [
    'js' => [
        'assets/bootstrap/dist/js/bootstrap.bundle.min.js|static',
        'after' => 0 //load after jquery
    ],
];

/**
 * Asset Components
 */
$GLOBALS['TL_COMPONENTS']['bs.tabcontrol'] = [
    'js' => [
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/tabcontrol/bs.tabcontrol.min.js|static',
    ]
];

$GLOBALS['TL_COMPONENTS']['bs.collapse'] = [
    'js' => [
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/collapse/bs.collapse.min.js|static',
    ]
];

$GLOBALS['TL_COMPONENTS']['bs.flatpickr'] = [
    'js'  => [
        'assets/flatpickr/dist/flatpickr.min.js|static',
        'assets/flatpickr/dist/l10n/de.js|static',
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/flatpickr/bs.flatpickr.min.js|static',
    ],
    'css' => [
        'assets/flatpickr/dist/flatpickr.min.css|screen|static',
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.select'] = [
    'js'  => [
        'assets/bootstrap-select/dist/js/bootstrap-select.min.js|static',
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/select/bs.select.i18n.min.js|static',
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/select/bs.select.min.js|static',
    ],
    'css' => [
        'assets/bootstrap-select/dist/css/bootstrap-select.min.css|screen|static',
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.inputSlider'] = [
    'js'  => [
        'system/modules/bootstrapper/assets/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js|static',
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/input-slider/bs.inputSlider.min.js|static',
    ],
    'css' => [
        'system/modules/bootstrapper/assets/vendor/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css|screen|static',
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.tooltip'] = [
    'js' => [
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/tooltip/bs.tooltip.min.js|static',
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.scrollSmooth'] = [
    'js' => [
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/scroll-smooth/bs.scroll-smooth.min.js|static',
    ],
];

$GLOBALS['TL_COMPONENTS']['modernizr'] = [
    'js' => [
        'assets/modernizr/dist/modernizr-custom.js|static',
    ],
];
$GLOBALS['TL_COMPONENTS']['fastclick'] = [
    'js' => [
        'assets/fastclick/lib/fastclick.min.js|static',
    ],
];

$GLOBALS['TL_COMPONENTS']['bs.switch'] = [
    'js'  => [
        'system/modules/bootstrapper/assets/vendor/bootstrap-switch/dist/js/bootstrap-switch.min.js|static',
        BOOTSTRAPPER_JS_COMPONENT_DIR . '/switch/bs.switch.min.js|static',
    ],
    'css' => [
        'system/modules/bootstrapper/assets/vendor/bootstrap-switch/dist/css/bootstrap-switch.css|screen|static',
    ],
];

$GLOBALS['TL_COMPONENTS']['animate.css'] = [
    'css' => [
        'system/modules/bootstrapper/assets/vendor/animate/animate.min.css|screen|static',
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
$GLOBALS['TL_FFL']['slider']             = 'HeimrichHannot\Bootstrapper\FormSlider';
$GLOBALS['TL_FFL']['submit']             = 'HeimrichHannot\FormButtonSubmit';
$GLOBALS['TL_FFL']['successGroup']       = 'HeimrichHannot\FormSuccessGroup';

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

if (is_array($GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'])) {
    array_insert($GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'], 0, [['HeimrichHannot\BootstrapperHooks', 'hookReplaceDynamicScriptTagsHook']]);
} else
{
    $GLOBALS['TL_HOOKS']['replaceDynamicScriptTags'][] = ['HeimrichHannot\BootstrapperHooks', 'hookReplaceDynamicScriptTagsHook'];
}

/**
 * CSS
 */
// currently no bs4 support
//$GLOBALS['TL_USER_CSS']['jasny-bootstrap']  = 'system/modules/bootstrapper/assets/vendor/jasny-bootstrap/less/jasny-bootstrap.less|screen|static|3.1.3';

array_insert($GLOBALS['TL_USER_CSS'], 1, [
    'bs.flatpickr'     => 'assets/flatpickr/dist/flatpickr.min.css|screen|static',
    'animate'          => 'system/modules/bootstrapper/assets/vendor/animate/animate.min.css|screen|static',
    'bootstrap-slider' => 'system/modules/bootstrapper/assets/vendor/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css|screen|static',
    'boostrap-select'  => 'assets/bootstrap-select/dist/css/bootstrap-select.min.css|screen|static',
    'bs.switch'        => 'system/modules/bootstrapper/assets/vendor/bootstrap-switch/dist/css/bootstrap-switch.css|screen|static',
]);

/**
 * JS
 */
if (\HeimrichHannot\Haste\Util\Container::isFrontend())
{

    $GLOBALS['TL_JAVASCRIPT']['bs.core'] = 'assets/bootstrap/dist/js/bootstrap.bundle.min.js|static';

    array_insert($GLOBALS['TL_JAVASCRIPT'], 1, [
        'fastclick' => 'assets/fastclick/lib/fastclick.min.js|static',
        // bootstrap-datetimepicker
        'moment'                   => 'system/modules/bootstrapper/assets/vendor/moment/min/moment-with-locales.min.js|static',
        'numeral'                  => 'system/modules/bootstrapper/assets/vendor/numeral/min/numeral.min.js|static',
        'numeral-languages'        => 'system/modules/bootstrapper/assets/vendor/numeral/min/languages.min.js|static',
        // bootstrap gallery gesture/touch support
        'jquery-validation'        => 'system/modules/bootstrapper/assets/vendor/validation/jquery.validate.min.js|static',
        'methods_de'               => 'system/modules/bootstrapper/assets/vendor/validation/methods_de.min.js|static',
        'messages_de'              => 'system/modules/bootstrapper/assets/vendor/validation/messages_de.min.js|static',
        'jquery-placeholder'       => 'system/modules/bootstrapper/assets/vendor/jquery.placeholder.min.js|static',
        'bootstrap-hover-dropdown' => 'system/modules/bootstrapper/assets/vendor/bootstrap-hover-dropdown-master/bootstrap-hover-dropdown.min.js|static',
        'jquery.actual'            => 'system/modules/bootstrapper/assets/vendor/jquery.actual/jquery.actual.min.js|static',
        // needs to be after vendor libs
        'bootstrapper-widgets'     => 'system/modules/bootstrapper/assets/js/jquery.bootstrapper-widgets.min.js|static',
        'bootstrapper'             => 'system/modules/bootstrapper/assets/js/jquery.bootstrapper.min.js|static',
        'bootbox'                  => 'system/modules/bootstrapper/assets/vendor/bootbox.js/bootbox.min.js|static',
        'flatpickr'                => 'assets/flatpickr/dist/flatpickr.min.js|static',
        'flatpickr.de'             => 'assets/flatpickr/dist/l10n/de.js|static',
        'bs-flatpickr'             => BOOTSTRAPPER_JS_COMPONENT_DIR . '/flatpickr/bs.flatpickr.min.js|static',
        'modernizr'                => 'assets/modernizr/dist/modernizr-custom.js|static',
        'bs.scrollSmooth'          => BOOTSTRAPPER_JS_COMPONENT_DIR . '/scroll-smooth/bs.scroll-smooth.min.js|static',
        'bs.tooltip'               => BOOTSTRAPPER_JS_COMPONENT_DIR . '/tooltip/bs.tooltip.min.js|static',
        'bootstrap-slider'         => 'system/modules/bootstrapper/assets/vendor/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js|static',
        'bs.inputSlider'           => BOOTSTRAPPER_JS_COMPONENT_DIR . '/input-slider/bs.inputSlider.min.js|static',

        'boostrap-select' => 'assets/bootstrap-select/dist/js/bootstrap-select.min.js|static',
        'bs.select.i18'   => BOOTSTRAPPER_JS_COMPONENT_DIR . '/select/bs.select.i18n.min.js|static',
        'bs.select'       => BOOTSTRAPPER_JS_COMPONENT_DIR . '/select/bs.select.min.js|static',

        'boostrap-switch' => 'system/modules/bootstrapper/assets/vendor/bootstrap-switch/dist/js/bootstrap-switch.min.js|static',
        'bs.switch'       => BOOTSTRAPPER_JS_COMPONENT_DIR . '/switch/bs.switch.min.js|static',
        'bs.collapse'     => BOOTSTRAPPER_JS_COMPONENT_DIR . '/collapse/bs.collapse.min.js|static',
        'bs.tabcontrol'   => BOOTSTRAPPER_JS_COMPONENT_DIR . '/tabcontrol/bs.tabcontrol.min.js|static',
        // currently no bs4 support
        // 'jasny-bootstrap'          => 'system/modules/bootstrapper/assets/vendor/jasny-bootstrap/dist/js/jasny-bootstrap.min.js|static',
    ]);
}
