<?php

namespace Kernel\Resources;

use Kernel\Resources\Http\Session;

class Template
{
    private $title;

    public function __construct(private Session $session)
    {
    }

    public function view(string $template, array $variables = []): void
    {
        extract(array_merge($this->extraData(), $variables));

        include_once ROOT_PATH.'/view/layout/'.$template.'.template.php';
    }

    public function component(string $component, array $variables = []): void
    {
        extract(array_merge($variables, $this->extraData()));
        include ROOT_PATH."/view/components/$component.component.php";
    }

    private function extraData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
        ];
    }

    public function title(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
