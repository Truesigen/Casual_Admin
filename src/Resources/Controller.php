<?php

namespace Kernel\Resources;

use Kernel\Resources\Http\Response;
use Kernel\Resources\Http\Session;

abstract class Controller
{
    public function __construct(protected Entity $page, protected Template $template, protected Validation $validation, protected Response $response, protected Session $session)
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
            call_user_func([$this, $actionName]);
        }
    }

    protected function assignPage(array $pageData = []): void
    {
        $this->template->title($this->page->title);
        $this->template->view($this->page->template, $pageData);
    }
}
