<?php
use Phalcon\Session\Adapter\Files as Session;
class  SessionController extends  ControllerBase{

        private function  _registerSession($id,$login,$password){
            $this ->session->set(
                'auth',[
                    'id'   => $id,
                    'login' => $login,
                    'password' => $password
                ]
            );

        }
    public function indexAction(){
            $login = $this ->request->getPost('login');
            $password = $this ->request->getPost('password');
            $us = Users::findFirst(
                [
                  "login = '$login'",
                    "password = '$password'"

                ]

            );

            if($us){
                $id = $us->id;
                $this->_registerSession($id,$login,$password);
                return $this -> dispatcher->forward(
                    [
                        'controller' => 'profile',
                        'action'     => 'index'
                    ]


                );
            }
            else{
                return $this -> dispatcher->forward(
                    [
                        'controller' => 'profile',
                        'action'     => 'Error'
                    ]


                );
            }


    }

}