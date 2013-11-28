<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
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
	'formbs_submit'   => 'system/modules/bootstrapper/templates',
	'formbs_checkbox' => 'system/modules/bootstrapper/templates',
	'formbs_radio'    => 'system/modules/bootstrapper/templates',
	'formbs_captcha'  => 'system/modules/bootstrapper/templates',
	'formbs_textarea' => 'system/modules/bootstrapper/templates',
	'formbs_text'     => 'system/modules/bootstrapper/templates',
));
