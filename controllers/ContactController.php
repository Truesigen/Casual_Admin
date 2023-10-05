<?php


class ContactController extends Controller{

    function runBeforeAction(){
        
        if($_SESSION['has_submitted_the_form'] ?? 0 == 1){
         
            $dbh = DatabaseConnection::getInstance();
            $dbc = $dbh->getConnection();

            $pageObj = new Page($dbc);
            $pageObj->findBy('id', 3);
            $variables['pageObj'] = $pageObj;

           
            $this->template->view('contact/contact-us-already', $variables);
            return false;
         }
         return true;
    }
    
     function defaultAction(){

        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);
        $variables['pageObj'] = $pageObj;
        
        $this->template->view('contact/contact-us', $variables);

        
    }

    function submitContactFormAction(){
         $_SESSION['has_submitted_the_form'] = 1;

         $dbh = DatabaseConnection::getInstance();
         $dbc = $dbh->getConnection();

         $pageObj = new Page($dbc);
         $pageObj->findBy('id', 5);
         $variables['pageObj'] = $pageObj;

       
         
         $this->template->view('contact/thank', $variables);
         
    }

     
}






?>