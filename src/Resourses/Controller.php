<?php

namespace App\Resourses;

abstract class Controller
{
    protected int $entity;

    protected Template $template;

    protected DatabaseConnection $dbc;

    protected EntityInterface $page;

    protected EntityInterface $user;

    protected EntityInterface $routes;

    protected Validation $validation;

    public function setValidation(Validation $validation)
    {
        $this->validation = $validation;
    }

    public function setTemplate(Template $template)
    {
        $this->template = $template;
    }

    public function setDbc(DatabaseConnection $dbc)
    {
        $this->dbc = $dbc;
    }

    public function setPage(EntityInterface $page)
    {
        $this->page = $page;
    }

    public function setUser(EntityInterface $user)
    {
        $this->user = $user;
    }

    public function setRoutes(EntityInterface $routes)
    {
        $this->routes = $routes;
    }

    public function runAction(string $actionName = 'default')
    {
        if (method_exists($this, 'runBeforeAction')) {
            $result = $this->runBeforeAction();
            if ($result == false) {
                return false;
            }
        }

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
