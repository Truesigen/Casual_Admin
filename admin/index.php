<?php
session_start();
//root path to files
define('ROOT_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR.'../');
define('VIEW_PATH', ROOT_PATH.DIRECTORY_SEPARATOR.'admin/view'.DIRECTORY_SEPARATOR);

spl_autoload_register(function ($class) {
    if (file_exists(ROOT_PATH.'src/'.$class.'.php')) {
        include ROOT_PATH.'src/'.$class.'.php';
    } elseif (file_exists(ROOT_PATH.'src/validateRules/'.$class.'.php')) {
        include ROOT_PATH.'src/validateRules/'.$class.'.php';
    }
});

require_once ROOT_PATH.'src/validatorInterface.php';
require_once ROOT_PATH.'model/page.php';
require_once ROOT_PATH.'admin/model/user.php';

//database connection
DatabaseConnection::connect('127.0.0.1:3306', 'crm', 'root', 'zero1019');
$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';

if ($module == 'dashboard') {
    include_once ROOT_PATH.'admin/controllers/DashboardController.php';
    $dashboard = new DashboardController();
    $dashboard->dbc = $dbc;
    $dashboard->template = new Template('admin/default');
    $dashboard->runAction($action);
} elseif ($module == 'page') {
    include_once ROOT_PATH.'admin/controllers/AdminPageController.php';
    $dashboard = new AdminPageController();
    $dashboard->dbc = $dbc;
    $dashboard->template = new Template('admin/default');
    $dashboard->runAction($action);
}

?>

