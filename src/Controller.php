<?php

class Controller
{
    /**
     * main Controller, others controllers extends this class,
     * init starting from runAction method, which get string parameters.
     */
    protected $entityId;

    public $template;

    public $templateFooter;

    public $dbc;

    public function runAction($actionName = 'default')
    {
        if (method_exists($this, 'runBeforeAction')) {
            $result = $this->runBeforeAction();
            if ($result == false) {
                return false;
            }
        }

        $actionName .= 'Action';
        if (method_exists($this, $actionName)) {
            $this->$actionName();
        } else {
            include 'view/status/404.html';
        }
    }

    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
    }
}
