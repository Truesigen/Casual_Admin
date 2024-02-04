<?php

namespace Kernel;

use Kernel\Resources\Container;
use Kernel\Resources\Factories\EntityFactory;
use Kernel\Resources\Http\Server;

class AppStarter
{
    use Server;

    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function run(): void
    {
        $app = EntityFactory::make('route')->find('pretty_url', $this->uri());

        if (empty($app) || ! property_exists($app, 'module')) {
            echo 'Not found';
            http_response_code(404);

            return;
        }

        $module = ucfirst($app->module).'Controller';
        if (file_exists(ROOT_PATH."/app/Controllers/{$module}.php")) {
            $class = 'App\Controllers\\'.$module;
            $controller = new $class($app->page, $this->container->template, $this->container->validation, $this->container->response, $this->container->session);
            $controller->runAction($app->action);
        }
    }
}
