<?php
/**
 * @package Agenda Telefonica
 *
 * APPLICATION-WIDE CONFIGURATION SETTINGS
 *
 * This file contains application-wide configuration settings.  The settings
 * here will be the same regardless of the machine on which the app is running.
 *
 * This configuration should be added to version control.
 *
 * No settings should be added to this file that would need to be changed
 * on a per-machine basic (ie local, staging or production).  Any
 * machine-specific settings should be added to _machine_config.php
 */

/**
 * APPLICATION ROOT DIRECTORY
 * If the application doesn't detect this correctly then it can be set explicitly
 */
if (!GlobalConfig::$APP_ROOT) GlobalConfig::$APP_ROOT = realpath("./");

/**
 * check is needed to ensure asp_tags is not enabled
 */
if (ini_get('asp_tags')) 
	die('<h3>Server Configuration Problem: asp_tags is enabled, but is not compatible with Savant.</h3>'
	. '<p>You can disable asp_tags in .htaccess, php.ini or generate your app with another template engine such as Smarty.</p>');

/**
 * INCLUDE PATH
 * Adjust the include path as necessary so PHP can locate required libraries
 */
set_include_path(
		GlobalConfig::$APP_ROOT . '/libs/' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/../phreeze/libs' . PATH_SEPARATOR .
		GlobalConfig::$APP_ROOT . '/vendor/phreeze/phreeze/libs/' . PATH_SEPARATOR .
		get_include_path()
);

/**
 * COMPOSER AUTOLOADER
 * Uncomment if Composer is being used to manage dependencies
 */
// $loader = require 'vendor/autoload.php';
// $loader->setUseIncludePath(true);

/**
 * SESSION CLASSES
 * Any classes that will be stored in the session can be added here
 * and will be pre-loaded on every page
 */
require_once "App/ExampleUser.php";

/**
 * RENDER ENGINE
 * You can use any template system that implements
 * IRenderEngine for the view layer.  Phreeze provides pre-built
 * implementations for Smarty, Savant and plain PHP.
 */
require_once 'verysimple/Phreeze/SavantRenderEngine.php';
GlobalConfig::$TEMPLATE_ENGINE = 'SavantRenderEngine';
GlobalConfig::$TEMPLATE_PATH = GlobalConfig::$APP_ROOT . '/templates/';

/**
 * ROUTE MAP
 * The route map connects URLs to Controller+Method and additionally maps the
 * wildcards to a named parameter so that they are accessible inside the
 * Controller without having to parse the URL for parameters such as IDs
 */
GlobalConfig::$ROUTE_MAP = array(

	// default controller when no route specified
	'GET:' => array('route' => 'Default.Home'),
		
	// example authentication routes
	'GET:loginform' => array('route' => 'SecureExample.LoginForm'),
	'POST:login' => array('route' => 'SecureExample.Login'),
	'GET:secureuser' => array('route' => 'SecureExample.UserPage'),
	'GET:secureadmin' => array('route' => 'SecureExample.AdminPage'),
	'GET:logout' => array('route' => 'SecureExample.Logout'),
		
	// Administrar_Funcionalidade
	'GET:administrar_funcionalidades' => array('route' => 'Administrar_Funcionalidade.ListView'),
	'GET:administrar_funcionalidade/(:num)' => array('route' => 'Administrar_Funcionalidade.SingleView', 'params' => array('id' => 1)),
	'GET:api/administrar_funcionalidades' => array('route' => 'Administrar_Funcionalidade.Query'),
	'POST:api/administrar_funcionalidade' => array('route' => 'Administrar_Funcionalidade.Create'),
	'GET:api/administrar_funcionalidade/(:num)' => array('route' => 'Administrar_Funcionalidade.Read', 'params' => array('id' => 2)),
	'PUT:api/administrar_funcionalidade/(:num)' => array('route' => 'Administrar_Funcionalidade.Update', 'params' => array('id' => 2)),
	'DELETE:api/administrar_funcionalidade/(:num)' => array('route' => 'Administrar_Funcionalidade.Delete', 'params' => array('id' => 2)),
		
	// Administrar_Modulo
	'GET:administrar_modulos' => array('route' => 'Administrar_Modulo.ListView'),
	'GET:administrar_modulo/(:num)' => array('route' => 'Administrar_Modulo.SingleView', 'params' => array('id' => 1)),
	'GET:api/administrar_modulos' => array('route' => 'Administrar_Modulo.Query'),
	'POST:api/administrar_modulo' => array('route' => 'Administrar_Modulo.Create'),
	'GET:api/administrar_modulo/(:num)' => array('route' => 'Administrar_Modulo.Read', 'params' => array('id' => 2)),
	'PUT:api/administrar_modulo/(:num)' => array('route' => 'Administrar_Modulo.Update', 'params' => array('id' => 2)),
	'DELETE:api/administrar_modulo/(:num)' => array('route' => 'Administrar_Modulo.Delete', 'params' => array('id' => 2)),
		
	// Administrar_Usuario
	'GET:administrar_usuarios' => array('route' => 'Administrar_Usuario.ListView'),
	'GET:administrar_usuario/(:num)' => array('route' => 'Administrar_Usuario.SingleView', 'params' => array('id' => 1)),
	'GET:api/administrar_usuarios' => array('route' => 'Administrar_Usuario.Query'),
	'POST:api/administrar_usuario' => array('route' => 'Administrar_Usuario.Create'),
	'GET:api/administrar_usuario/(:num)' => array('route' => 'Administrar_Usuario.Read', 'params' => array('id' => 2)),
	'PUT:api/administrar_usuario/(:num)' => array('route' => 'Administrar_Usuario.Update', 'params' => array('id' => 2)),
	'DELETE:api/administrar_usuario/(:num)' => array('route' => 'Administrar_Usuario.Delete', 'params' => array('id' => 2)),
		
	// Agenda_Telefonica
	'GET:administrar_agenda' => array('route' => 'Agenda_Telefonica.ListView'),
	'GET:agenda_telefonica/(:num)' => array('route' => 'Agenda_Telefonica.SingleView', 'params' => array('id' => 1)),
	'GET:api/administrar_agenda' => array('route' => 'Agenda_Telefonica.Query'),
	'POST:api/agenda_telefonica' => array('route' => 'Agenda_Telefonica.Create'),
	'GET:api/agenda_telefonica/(:num)' => array('route' => 'Agenda_Telefonica.Read', 'params' => array('id' => 2)),
	'PUT:api/agenda_telefonica/(:num)' => array('route' => 'Agenda_Telefonica.Update', 'params' => array('id' => 2)),
	'DELETE:api/agenda_telefonica/(:num)' => array('route' => 'Agenda_Telefonica.Delete', 'params' => array('id' => 2)),

	// catch any broken API urls
	'GET:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'PUT:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'POST:api/(:any)' => array('route' => 'Default.ErrorApi404'),
	'DELETE:api/(:any)' => array('route' => 'Default.ErrorApi404')
);

/**
 * FETCHING STRATEGY
 * You may uncomment any of the lines below to specify always eager fetching.
 * Alternatively, you can copy/paste to a specific page for one-time eager fetching
 * If you paste into a controller method, replace $G_PHREEZER with $this->Phreezer
 */
// $GlobalConfig->GetInstance()->GetPhreezer()->SetLoadType("AdmModulos","adm_modulos_ibfk_1",KM_LOAD_EAGER); // KM_LOAD_INNER | KM_LOAD_EAGER | KM_LOAD_LAZY
?>