<?php
class  profileController extends ControllerBase{
    function indexAction()
    {

       if($this ->session->get('auth')){
           $this ->response -> qw = "<script> alert();</script>";

       }
    }
    public function ErrorAction()
    {
        echo ("Вы не авторизованы!!");
    }

}

