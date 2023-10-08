<?php

require_once ROOT_PATH.'model/page.php';
require_once ROOT_PATH.'admin/model/user.php';

class AppStarter
{
    private $dbc;

    private $routes;

    public function __construct($dbc)
    {
        $this->dbc = $dbc;
        $this->routes = new Routes($dbc);
    }

    public function run($action)
    {
        $start = $this->beforeRun($action);

        if ($start == false) {
            include_once ROOT_PATH.'controllers\ExeptionsController.php';
            $exeptions = new Exeptions();
            $exeptions->template = new Template('layout/default');
            $exeptions->runAction('default');
            exit();
        }

        $this->start($start);
    }

    private function beforeRun($actionName)
    {
        $action = $this->routes->findBy('pretty_url', $actionName);

        if (empty($action->module)) {
            return false;
        }

        $runController = [
            'controller' => ucfirst($action->module).'Controller',
            'action' => $action->action,
            'entityId' => $action->entity_id,
        ];

        return $runController;
    }

    private function start($start)
    {
        $module = $start['controller'];
        $moduleAction = $start['action'];
        $moduleId = $start['entityId'];
        $ControllerFile = ROOT_PATH.'controllers/'.$module.'.php';

        include_once $ControllerFile;
        $runController = new $module();
        $runController->dbc = $this->dbc;
        $runController->template = new Template('layout/default');
        $runController->setEntityId($moduleId);
        $runController->runAction($moduleAction);
    }
}
