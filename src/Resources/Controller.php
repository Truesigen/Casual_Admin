<?php

namespace App\Resources;

use App\Models\EntityFactory;
use App\Resources\Http\Redirect;
use App\Resources\Http\Request;
use App\Resources\Http\Session;

abstract class Controller
{
    public function __construct(protected int $pageId, protected Template $template, protected Validation $validation, protected Redirect $redirect, protected Session $session)
    {
    }

    public function runAction(string $actionName)
    {
        if (method_exists($this, 'runBeforeAction')) {
            $result = $this->runBeforeAction();
            if ($result == false) {
                return false;
            }
        }

        if (method_exists($this, $actionName)) {
            empty($_REQUEST) ? $this->$actionName() : call_user_func([$this, $actionName], new Request());
        }
    }

    protected function assignPage(array $pageData = []): void
    {
        $page = EntityFactory::make('Page')->find('id', $this->pageId);
        $this->template->title($page->title);
        $this->template->view($page->template, $pageData);
    }
}
