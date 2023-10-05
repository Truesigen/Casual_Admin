<?php


class TeamController extends Controller{

    function defaultAction(){
        
       
        
        $userObj = new User($this->dbc);
        $variables['pageObj'] = $userObj->getTeam();
       
        

        $this->template->view('status/team', $variables);
        
    }


}






?>