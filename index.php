<?php

session_start();
//root path to files
define('ROOT_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR);

require_once ROOT_PATH.'vendor/autoload.php';

spl_autoload_register(function ($class) {
    if (file_exists(ROOT_PATH.'src/'.$class.'.php')) {
        include ROOT_PATH.'src/'.$class.'.php';
    } elseif (file_exists(ROOT_PATH.'src/validateRules/'.$class.'.php')) {
        include ROOT_PATH.'src/validateRules/'.$class.'.php';
    }
});

require_once ROOT_PATH.'model/page.php';
require_once ROOT_PATH.'admin/model/user.php';

//database connection
DatabaseConnection::connect('127.0.0.1:3306', 'crm', 'root', 'zero1019');

$action = $_GET['seo_name'] ?? 'home';

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

//init routing

$router = new Routes($dbc);
$router->findBy('pretty_url', $action);

$action = $router->action != '' ? $router->action : 'default';

$moduleName = ucfirst($router->module).'Controller';
$ControllerFile = ROOT_PATH.'controllers/'.$moduleName.'.php';

if (file_exists($ControllerFile)) {
    include_once $ControllerFile;
    $Controller = new $moduleName();
    $Controller->dbc = $dbc;
    $Controller->template = new Template('layout/default');
    $Controller->setEntityId($router->entity_id);
    $Controller->runAction($action);
}
