<?php
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\PresenceOf;

class authForms extends  Form {

    public function initialize(){
        $validation = new Validation();
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
        $validation -> add(
            'login',
            new PresenceOf(
                [
                    'message'      => 'The telephone is required',

                ]
            )
        );


        }




}