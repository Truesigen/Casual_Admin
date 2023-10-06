<?php

class DashboardController extends Controller
{
    public function runBeforeAction()
    {
        if ($_SESSION['is_admin'] ?? false == true) {
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? '';
        if ($action != 'login') {
            header('Location: /admin/?module=dashboard&action=login');
        } else {
            return true;
        }
    }

      public function defaultAction()
      {
          $this->template->view('static_page', []);

          exit();
      }

    public function loginAction()
    {
        if ($_POST['postAction'] ?? 0 == 1) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $validationUsername = new Validation();

            if (! $validationUsername
                           ->addRule(new ValidateNoEmptySpaces())
                           ->addRule(new ValidateEmail())
                           ->validate($username)
            ) {
                $_SESSION['validationRules']['errorEmail'] = $validationUsername->getAllError();
            }

            $validationPassword = new Validation();
            if (! $validationPassword
              ->addRule(new ValidateMinimum(3))
              ->addRule(new ValidateMaximum(20))
              ->addRule(new ValidateNoEmptySpaces())
              ->addRule(new ValidateSpecialCharacters())
              ->validate($password)
            ) {
                $_SESSION['validationRules']['errorPassword'] = $validationPassword->getAllError();
            }

            if (empty($_SESSION['validationRules'])) {
                $auth = new Auth();

                if ($auth->checkLogin($username, $password)) {
                    $_SESSION['is_admin'] = 1;

                    header('Location: /admin/');

                    exit();
                }
                $_SESSION['validationRules']['errors'] = [0 => 'Incorrect email or Password'];
            }
        }

        include_once VIEW_PATH.'admin/login.html';
        unset($_SESSION['validationRules']);
    }
}
