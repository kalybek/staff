<?php
class  usersController extends ControllerBase{


    function indexAction(){
        $this -> view->form=new authForms();

    }

}