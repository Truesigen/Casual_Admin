<?php

namespace App\Resourses;

class Template
{
    private $layout;

    public function view($template, $variables = [])
    {
        extract(array_merge($this->extraData(), $variables));

        include_once ROOT_PATH.'/view/layout/'.$template.'.template.php';
    }

    public function component($component)
    {
        include_once ROOT_PATH."/view/components/$component.component.php";
    }

    private function extraData()
    {
        return [
            'view' => $this,
        ];
    }
}
