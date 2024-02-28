<?php

namespace Kernel\Resources;

abstract class Controller
{
    public function __construct(protected Container $container)
    {
    }

    final public function runAction(array $action)
    {
        if (method_exists($this, 'runBeforeAction')) {
            $result = $this->runBeforeAction();
            if ($result == false) {
                return false;
            }
        }

        if (method_exists($this, $action[0])) {
            call_user_func([$this, $action[0]], $action[1]);
        }
    }

    protected function assignPage(string $view, array $pageData = []): void
    {
        $this->container->template->view($view, $pageData);
    }
}
