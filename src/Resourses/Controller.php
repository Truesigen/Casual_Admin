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

    protected EntityInterface $events;

    protected Validation $validation;

    public function setValidation(Validation $validation)
    {
        $this->validation = $validation;
    }

    public function setEvent(EntityInterface $events)
    {
        $this->events = $events;
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
        }

        if (method_exists($this, 'runAfterAction')) {
            $this->runAfterAction();
        }
    }

    protected function assignPage(string $valueName = '', $pageData = []): void
    {
        if (isset($pageData)) {
            $data[$valueName] = $pageData;
        }

        $page = $this->page->first('id', $this->entityId);
        $this->template->title($page->title);
        $this->template->view($page->template, $data);
    }

    public function setEntityId($entityId)
    {
        $this->entityId = $entityId;
    }
}
