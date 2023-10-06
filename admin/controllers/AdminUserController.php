<?php

class AdminUserController extends Controller
{
    public function defaultAction()
    {
        $UserObj = new User($this->dbc);
        $UserValues['Obj'] = $UserObj->findAll();

        $this->template->view('admin/service', $UserValues);
    }

    public function editUserAction()
    {
        $userId = $_GET['id'];
        $userObj = new User($this->dbc);
        $userHandle['Obj'] = $userObj->findBy('id', $userId);

        $this->template->view('admin/edit_page', $userHandle);
    }

    public function AdduserAction()
    {
        if ($_POST['is_active'] ?? 0 == 1) {
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $pwd = $_POST['pwd'] ?? null;
            $pwd2 = $_POST['pwd2'] ?? null;
            $id = null;
            $terms = $_POST['terms'] ?? null;

            if (! $terms ?? null == 'agree') {
                $_SESSION['registerValidation']['terms'] = [0 => 'You should accept our rules'];
            }

            $validationName = new Validation();

            if (! $validationName->addRule(new ValidateNoEmptySpaces())
                            ->validate($name)
            ) {
                $_SESSION['registerValidation']['errorName'] = $validationName->getAllError();
            }

            $validationEmail = new Validation();

            if (! $validationEmail->addRule(new ValidateEmail())
                            ->addRule(new ValidateNoEmptySpaces())
                            ->validate($email)
            ) {
                $_SESSION['registerValidation']['errorEmail'] = $validationEmail->getAllError();
            }

            $validationPwd = new Validation();

            if (! $validationPwd->addRule(new ValidateMaximum(20))
                           ->addRule(new ValidateMinimum(6))
                           ->addRule(new ValidateSpecialCharacters())
                           ->addRule(new ValidateNoEmptySpaces())
                           ->validate($pwd)
            ) {
                $_SESSION['registerValidation']['errorPassword'] = $validationPwd->getAllError();
            }

            if (! $pwd || $pwd !== $pwd2) {
                $_SESSION['registerValidation']['errorPassword'] = [0 => 'not same password'];
            }
        }

        if ($_POST['is_active'] ?? 0 == 1 && empty($_SESSION['registerValidation'])) {
            $UserObj = new User($this->dbc);

            $data = $UserObj->checkUser('username', $email);

            if ($data == false && empty($_SESSION['registerValidation'])) {
                $values = [$id, $name, $email, password_hash($pwd, PASSWORD_DEFAULT)];
                $register = $UserObj->createNewUser($values);

                if ($register == true) {
                    exit();
                } else {
                    $_SESSION['registerValidation']['errorRegister'] = [0 => 'Something wrong'];
                }
            } else {
                $_SESSION['registerValidation']['errorUser'] = [0 => 'User with this email already exsists.'];
            }
        }

        $this->template->view('admin/add_user', []);
        unset($_SESSION['registerValidation']);
    }
}
