<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package Bootstrapper
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'HeimrichHannot',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Forms
	'HeimrichHannot\FormSuccessGroup'                => 'system/modules/bootstrapper/forms/FormSuccessGroup.php',
	'HeimrichHannot\FormButtonSubmit'                => 'system/modules/bootstrapper/forms/FormButtonSubmit.php',

	// Modules
	'HeimrichHannot\AjaxContent\ModuleAjaxSubscribe' => 'system/modules/bootstrapper/modules/newsletter/ModuleAjaxSubscribe.php',
	'HeimrichHannot\ModuleNewsReader'                => 'system/modules/bootstrapper/modules/news/ModuleNewsReader.php',

	// Classes
	'HeimrichHannot\BootstrapperHooks'               => 'system/modules/bootstrapper/classes/BootstrapperHooks.php',
	'HeimrichHannot\Bootstrapper'                    => 'system/modules/bootstrapper/classes/Bootstrapper.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'form_successgroup'         => 'system/modules/bootstrapper/templates/forms',
	'nav_navbar'                => 'system/modules/bootstrapper/templates/navigation',
	'nav_list_unstyles'         => 'system/modules/bootstrapper/templates/navigation',
	'nav_navbar_collapse'       => 'system/modules/bootstrapper/templates/navigation',
	'nav_navbar_collapse_hover' => 'system/modules/bootstrapper/templates/navigation',
	'pagination'                => 'system/modules/bootstrapper/templates/pagination',
	'fe_page'                   => 'system/modules/bootstrapper/templates/frontend',
	'fe_page_styleguide'        => 'system/modules/bootstrapper/templates/frontend',
	'j_bootstrapgallery'        => 'system/modules/bootstrapper/templates/jquery',
	'news_full_modal'           => 'system/modules/bootstrapper/templates/news',
	'news_full_modal_content'   => 'system/modules/bootstrapper/templates/news',
	'mod_search_simple'         => 'system/modules/bootstrapper/templates/modules',
	'mod_password'              => 'system/modules/bootstrapper/templates/modules',
	'mod_newsreader_modal'      => 'system/modules/bootstrapper/templates/modules/news',
	'mod_search_advanced'       => 'system/modules/bootstrapper/templates/modules',
	'ce_accordion_start'        => 'system/modules/bootstrapper/templates/elements',
	'ce_hyperlink'              => 'system/modules/bootstrapper/templates/elements',
	'ce_accordion_stop'         => 'system/modules/bootstrapper/templates/elements',
	'styleguide_bs3'            => 'system/modules/bootstrapper/templates/styleguides',
	'bootstrapper_form'         => 'system/modules/bootstrapper/templates/widgets',
	'block_button'              => 'system/modules/bootstrapper/templates/block',
));

