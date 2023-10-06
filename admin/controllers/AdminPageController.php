<?php

class AdminPageController extends Controller
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
          $variables = [];
          $page = new Page($this->dbc);
          $pageHandler['Obj'] = $page->findAll();

          $this->template->view('admin/service', $pageHandler);
      }

      public function editPageAction()
      {
          $pageId = $_GET['id'];
          $page = new Page($this->dbc);
          $pageHandler['Obj'] = $page->findBy('id', $pageId);

          if ($_POST['action'] ?? 0 == 1) {
              $page->setValues($_POST);
              $page->saveValues();
          }

          $this->template->view('admin/edit_page', $pageHandler);
      }
}
