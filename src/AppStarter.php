<?php

namespace App;

use App\Models\EntityFactory;
use App\Resourses\Container;

class AppStarter
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function run(): void
    {
        $app = EntityFactory::make('Routes')->first('pretty_url', strtok($_SERVER['REQUEST_URI'], '?'));

        if (empty($app) || ! property_exists($app, 'module')) {
            echo 'Not found';
            http_response_code(404);

            return;
        }

        $module = ucfirst($app->module).'Controller';

        if (file_exists(ROOT_PATH."/src/Controllers/{$module}.php")) {
            $class = 'App\Controllers\\'.$module;
            $controller = new $class($app->entity_id, $this->container->template, $this->container->validation);
            $controller->runAction($app->action);
        }
    }
}
