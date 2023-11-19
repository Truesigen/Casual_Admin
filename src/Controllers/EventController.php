<?php

namespace App\Controllers;

use App\Models\EntityFactory;
use App\Resourses\Controller;
use App\Services\PageService;

class EventController extends Controller
{
    public function runBeforeAction()
    {
        if (! empty($_POST) && isset($_SESSION['user_id'])) {
            $validation = $this->validation->addRule(['required', 'min', 'max'])
            ->validate(['header' => $_POST['header'], 'description' => $_POST['description'], 'password' => $_POST['password']]);

            if (! $validation) {
                foreach ($this->validation->getAllErrors() as $key => $value) {
                    $_SESSION[$key] = $value;
                }

                header('Location: /event/new');
                exit;
            }

            $_POST['event_validation'] = 'passed';
        }

        return true;
    }

    public function create()
    {
        if ($_POST['event_validation'] ?? 0 == 1) {
            $event = $this->service()->checkPass($_POST['user_id'], $_POST['password']);

            if (empty($event)) {
                $_SESSION['event_error'] = 'Incorrect password';

                header('Location: /event/new');
                exit;
            }

            $result = $this->service()->insertEvent($_POST['user_id'], $_POST['header'], $_POST['description']);

            if (empty($result)) {
                $_SESSION['event_error'] = 'Something wrong';
            }
        }

        $this->assignPage();
    }

    public function explore()
    {
        if ($_SESSION['user_id'] ?? 0 == 1) {
            $this->assignPage(
                ['tasks' => EntityFactory::make('Event')->getTasks('user_id', $_SESSION['user_id']),
                    'events' => EntityFactory::make('Event')->getTasks('created_by', $_SESSION['user_id']),
                ]);
        } else {
            $this->assignPage();
        }
    }

    private function service(): PageService
    {
        return new PageService(EntityFactory::make('Event'), EntityFactory::make('User'));
    }
}
