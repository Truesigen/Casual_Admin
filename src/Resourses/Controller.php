<?php

namespace App\Resourses;

use App\Models\EntityFactory;

abstract class Controller
{
    public function __construct(protected int $entityId, protected Template $template, protected Validation $validation)
    {
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

    protected function assignPage(array $pageData = []): void
    {
        $page = EntityFactory::make('Page')->first('id', $this->entityId);
        $this->template->title($page->title);
        $this->template->view($page->template, $pageData);
    }

    public function setEntityId($entityId): void
    {
        $this->entityId = $entityId;
    }
}
