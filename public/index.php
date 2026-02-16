<?php

define('ROOT_PATH', dirname(__DIR__));

require_once ROOT_PATH.'/vendor/autoload.php';
use Kernel\AppStarter;

$app = new AppStarter;
$app->run();
