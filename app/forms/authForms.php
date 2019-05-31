<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;

class authForms extends  Form {

    public function initialize(){
        $this->add(
            new Text(
                'login'
            )
        );
        $this->add(
            new Text(
                'password'
            )
        );
    }

}