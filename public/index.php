<?php

session_start();
define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH.'/vendor/autoload.php';

use App\AppStarter;

$app = new AppStarter();
$app->run();
