<?php

class ContactController extends Controller
{
    public function runBeforeAction()
    {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1) {
            $pageObj = new Page($this->dbc);
            $pageObj->findBy('id', 3);
            $variables['pageObj'] = $pageObj;

            $this->template->view('contact/contact-us-already', $variables);

            return false;
        }

        return true;
    }

     public function defaultAction()
     {
         $pageObj = new Page($this->dbc);
         $pageObj->findBy('id', $this->entityId);
         $variables['pageObj'] = $pageObj;

         $this->template->view('contact/contact-us', $variables);
     }

    public function submitContactFormAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;

        $pageObj = new Page($this->dbc);
        $pageObj->findBy('id', 5);
        $variables['pageObj'] = $pageObj;

        $this->template->view('contact/thank', $variables);
    }
}
