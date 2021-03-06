<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces([
    'HeimrichHannot',
]);


/**
 * Register the classes
 */
ClassLoader::addClasses([
    // Forms
    'HeimrichHannot\FormSuccessGroup'                            => 'system/modules/bootstrapper/forms/FormSuccessGroup.php',
    'HeimrichHannot\FormButtonSubmit'                            => 'system/modules/bootstrapper/forms/FormButtonSubmit.php',
    'HeimrichHannot\Bootstrapper\FormSlider'                     => 'system/modules/bootstrapper/forms/FormSlider.php',

    // Modules
    'HeimrichHannot\AjaxContent\ModuleAjaxSubscribe'             => 'system/modules/bootstrapper/modules/newsletter/ModuleAjaxSubscribe.php',

    // Elements
    'Contao\ContentTabControl'                                   => 'system/modules/bootstrapper/elements/ContentTabControl.php',

    // Classes
    'HeimrichHannot\Bootstrapper\BootstrapperAssets'             => 'system/modules/bootstrapper/classes/BootstrapperAssets.php',
    'HeimrichHannot\Bootstrapper\BootstrapperComponent'          => 'system/modules/bootstrapper/classes/BootstrapperComponent.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormField'          => 'system/modules/bootstrapper/classes/BootstrapperFormField.php',
    'HeimrichHannot\Bootstrapper\Backend\Layout'                 => 'system/modules/bootstrapper/classes/Backend/Layout.php',
    'HeimrichHannot\Bootstrapper\BootstrapperButtonDropdown'     => 'system/modules/bootstrapper/classes/components/BootstrapperButtonDropdown.php',
    'HeimrichHannot\Bootstrapper\BootstrapperButton'             => 'system/modules/bootstrapper/classes/components/BootstrapperButton.php',
    'HeimrichHannot\BootstrapperHooks'                           => 'system/modules/bootstrapper/classes/BootstrapperHooks.php',
    'HeimrichHannot\Bootstrapper'                                => 'system/modules/bootstrapper/classes/Bootstrapper.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormRadio'          => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormRadio.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormSelect'         => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormSelect.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormConfirmedEmail' => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormConfirmedEmail.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormFileUpload'     => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormFileUpload.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormSubmit'         => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormSubmit.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormLegacy'         => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormLegacy.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormTextField'      => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormTextField.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormCheckBox'       => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormCheckBox.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormPassword'       => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormPassword.php',
    'HeimrichHannot\Bootstrapper\BootstrapperFormTextArea'       => 'system/modules/bootstrapper/classes/widgets/BootstrapperFormTextArea.php',
]);


/**
 * Register the templates
 */
TemplateLoader::addFiles([
    'form_slider'                               => 'system/modules/bootstrapper/templates/forms',
    'form_successgroup'                         => 'system/modules/bootstrapper/templates/forms',
    'nav_navbar'                                => 'system/modules/bootstrapper/templates/navigation',
    'nav_list_unstyles'                         => 'system/modules/bootstrapper/templates/navigation',
    'nav_navbar_collapse'                       => 'system/modules/bootstrapper/templates/navigation',
    'pagination'                                => 'system/modules/bootstrapper/templates/pagination',
    'fe_page'                                   => 'system/modules/bootstrapper/templates/frontend',
    'fe_page_styleguide'                        => 'system/modules/bootstrapper/templates/frontend',
    'j_bootstrapgallery'                        => 'system/modules/bootstrapper/templates/jquery',
    'mod_search_simple'                         => 'system/modules/bootstrapper/templates/modules',
    'mod_login_1cl'                             => 'system/modules/bootstrapper/templates/modules',
    'mod_password'                              => 'system/modules/bootstrapper/templates/modules',
    'mod_newsreader_modal'                      => 'system/modules/bootstrapper/templates/modules/news',
    'mod_login_2cl'                             => 'system/modules/bootstrapper/templates/modules',
    'mod_search_advanced'                       => 'system/modules/bootstrapper/templates/modules',
    'ce_tabcontrol_start'                       => 'system/modules/bootstrapper/templates/tabs',
    'ce_tabcontrol_tab'                         => 'system/modules/bootstrapper/templates/tabs',
    'ce_tabcontrol_stop'                        => 'system/modules/bootstrapper/templates/tabs',
    'ce_tabcontrol_end'                         => 'system/modules/bootstrapper/templates/tabs',
    'bootstrapper_button'                       => 'system/modules/bootstrapper/templates/components',
    'bootstrapper_button_dropdown'              => 'system/modules/bootstrapper/templates/components',
    'ce_accordion_start_group'                  => 'system/modules/bootstrapper/templates/elements',
    'ce_accordion_start'                        => 'system/modules/bootstrapper/templates/elements',
    'ce_hyperlink'                              => 'system/modules/bootstrapper/templates/elements',
    'ce_accordion_stop_group'                   => 'system/modules/bootstrapper/templates/elements',
    'ce_accordion_stop'                         => 'system/modules/bootstrapper/templates/elements',
    'styleguide_bs3'                            => 'system/modules/bootstrapper/templates/styleguides',
    'bootstrapper_form_select_option'           => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_upload'                  => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_select_optgroup'         => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_textarea'                => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_checkbox'                => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_checkbox_option'         => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_password'                => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form'                         => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_confirmed_email'         => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_radio'                   => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_radio_option'            => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_text'                    => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_select'                  => 'system/modules/bootstrapper/templates/widgets',
    'bootstrapper_form_submit'                  => 'system/modules/bootstrapper/templates/widgets',
    'block_unsearchable_bs3_modal'              => 'system/modules/bootstrapper/templates/block',
    'block_button'                              => 'system/modules/bootstrapper/templates/block',
]);
