<?php

class PageController extends Controller
{
    public function defaultAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);

        $pageObj->findBy('id', $this->entityId);

        $variables['pageObj'] = $pageObj;

        $this->template->view('static-page', $variables);
    }
}
