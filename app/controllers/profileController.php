<?php


use Phalcon\Mvc\Url;
class  profileController extends ControllerBase{

    function indexAction(){

       if($this ->session->get('auth')){
                $name = $this->session->get('auth')['login'];
                $this->view->setVar('name',$name);
        }
    }

    private function findDateUser($type="start"){
        $id = $this->session->get('auth')['id'];
        $date = date('Y-m-d');
        $obj = array(
            'status' => $type,
            'start_time' => date('h-i'),
            'stop_time'=>''
        );
        $obj_1 = json_encode($obj);
        $work = Working_version::findFirst(
            [
                "id_users  ='$id'",
                "date_work = '$date'"
            ]
        );
        return ['id'=>$id,'obj_1'=>$obj_1,'work'=>$work,'date'=>$date];
    }

    public function startAction(){



        if($this->request->getPost('status')=="start"){
                $this ->view->setVar("start","none");
                $this ->view->setVar("stop","block");
            $resurce = $this->findDateUser("start");
            if($resurce['work']){

                $data_json =  $resurce['work'] -> json_d;
                $update_json =  json_decode($data_json);
                $update_json->start_time.= ','.date('h-i');
                $resurce['work']->json_d = json_encode($update_json);
                $resurce['work'] ->save();

                $this->response->redirect('profile?start=none');


            }
            else{
                $work_new = new Working_version();
                $work_new ->id_users =$resurce['id'];
                $work_new->json_d =$resurce['obj_1'];
                $work_new ->date_work = $resurce['date'];
                $work_new->save();

                $this->response->redirect('profile?start=none');

            }

        }
    }

    public function stopAction(){
        $resurce = $this->findDateUser("stop");
        if($resurce['work']){

            $data_json =  $resurce['work'] -> json_d;
            $update_json =  json_decode($data_json);
            $update_json->stop_time.= ','.date('h-i');
            $resurce['work']->json_d = json_encode($update_json);
            $resurce['work'] ->save();

            $this->response->redirect('profile?stop=none');


        }

        else if ($this->request->getPost('status')=="stop"){

            $data_j = json_decode($resurce['work']->json_d);
            $data_j-> stop_time = date('h-i');
            $obj_1 = json_encode($data_j);
            $resurce['work']->json_d ="$obj_1";

            if( $resurce['work']->save()){
                $this->response->redirect('profile?stop=none');
            }
        }
    }

    public function ErrorAction()
    {
        echo ("Вы не авторизованы!!");
    }

}

