<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

// Urls amigables
$router = Zend_Controller_Front::getInstance()->getRouter();

$route = new Zend_Controller_Router_Route('/buscar/:criterio',
    array('module' => 'default',
          'controller' => 'index',
          'action' => 'buscar'
    )
);

$router->addRoute('buscador', $route);

$route = new Zend_Controller_Router_Route('/liga/:liga/:id',
    array('module' => 'default',
          'controller' => 'liga',
          'action' => 'index'
    ),
    array('id' => '\d+')
);

$router->addRoute('liga', $route);

$route = new Zend_Controller_Router_Route('/usuario/:usuario/:id',
    array('module' => 'default',
          'controller' => 'usuario',
          'action' => 'index'
    ),
    array('id' => '\d+')
);

$router->addRoute('usuario', $route);

$application->bootstrap()
            ->run();