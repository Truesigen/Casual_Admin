<?php

session_start();
define('ROOT_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR);

spl_autoload_register(function ($class) {
    if (file_exists(ROOT_PATH.'src/'.$class.'.php')) {
        include ROOT_PATH.'src/'.$class.'.php';
    } elseif (file_exists(ROOT_PATH.'src/validateRules/'.$class.'.php')) {
        include ROOT_PATH.'src/validateRules/'.$class.'.php';
    }
});

require_once 'model/AppStarter.php';

DatabaseConnection::connect();
$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$app = new AppStarter($dbc);
$app->run($_GET['seo_name'] ?? 'home');
