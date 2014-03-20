<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
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
	// Classes
	'HeimrichHannot\Bootstrapper' => 'system/modules/bootstrapper/classes/Bootstrapper.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_search_advanced' => 'system/modules/bootstrapper/templates/modules',
	'mod_search_simple'   => 'system/modules/bootstrapper/templates/modules',
	'fe_page'             => 'system/modules/bootstrapper/templates/frontend',
	'nav_navbar_collapse' => 'system/modules/bootstrapper/templates/navigation',
	'nav_navbar'          => 'system/modules/bootstrapper/templates/navigation',
	'nav_list_unstyles'   => 'system/modules/bootstrapper/templates/navigation',
	'ce_accordion_start'  => 'system/modules/bootstrapper/templates/elements',
	'ce_accordion_stop'   => 'system/modules/bootstrapper/templates/elements',
	'pagination'          => 'system/modules/bootstrapper/templates/pagination',
	'bootstrapper_form'   => 'system/modules/bootstrapper/templates/widgets',
	'j_bootstrapgallery'  => 'system/modules/bootstrapper/templates/jquery',
));
