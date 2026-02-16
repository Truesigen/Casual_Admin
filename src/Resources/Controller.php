<?php

namespace Kernel\Resources;

use Kernel\Resources\Http\Request;
use Kernel\Resources\Http\Response;
use Kernel\Resources\Http\Session;

abstract class Controller
{
    private readonly Request $request;

    private readonly Response $response;

    private readonly Validator $validator;

    private readonly ?Session $session;

    private readonly ?Template $template;

    final public function runAction(array $action)
    {
        if (method_exists($this, 'runBeforeAction')) {
            $result = call_user_func([$this, 'runBeforeAction']);
            if ($result == false) {
                return false;
            }
        }

        if (method_exists($this, $action[0])) {
            call_user_func([$this, $action[0]], $action[1]);
        }
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function response(): Response
    {
        return $this->response;
    }

    public function setValidator(Validator $validator): void
    {
        $this->validator = $validator;
    }

    public function validator(): Validator
    {
        return $this->validator;
    }

    public function setSession(?Session $session): void
    {
        $this->session = $session;
    }

    public function session(): ?Session
    {
        return $this->session;
    }

    public function setTemplate(?Template $template): void
    {
        $this->template = $template;
    }

    public function template(): ?Template
    {
        return $this->template;
    }

    protected function assignPage(string $view, array $pageData = []): void
    {
        $this->template->view($view, $pageData);
    }
}
