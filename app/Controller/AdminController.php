<?php

App::uses('AppController', 'Controller');
App::import('Model', 'Person');
App::import('Model', 'Adviser');

class AdminController extends AppController {

    public $uses = array('User');
    public $components = array('BinluuEmail');

    public function index(){
        $this->layout = "admin";
        if($this->Session->read('Auth.User.rol')!='Admin'){
            $this->Session->setFlash('No tienes permisos para acceder a esta opcion');
            $this->redirect(array('controller'=>'User','action'=>'home'));
        }
    }

    public function register(){
        $this->set('title_for_layout','Registro de usuarios');
        if (!empty($this->data)) {
            $data = $this->data;
            $data['User']['rol'] = "Admin";
            $data['User']['active'] = 1;
            $data['User']['mail_confirmed'] = 1;
            if($this->User->save($data)){
                $this->Session->setFlash('Registrado!');
                $this->BinluuEmail->sendMail($this->User->getInsertID(),$data['User']['username'],CONFIRM_EMAIL_TYPE);
                $this->redirect(array('controller'=>'User','action' => 'login'));
            }else{
                $this->Session->setFlash("Ha ocurrido en error, intente de nuevo.");
            }
        }
    }

    public function contact(){
        if(!empty($this->data)){
            $this->BinluuEmail->sendConfirmMail($this->data['name'],$this->data['email'],$this->data['message']);
            $this->Session->setFlash("Tu mensaje se ha enviado correctamente. En breve nos pondremos en contacto.");
        }
    }

    public function edit( $id = null){

        $id = $id!=null?$id:$this->Session->read('Auth.User.id');

        if(!empty($this->data)){
            $data = $this->data;
            $data['User']['id'] = $id;
            if($this->User->save($data)){
                $this->Session->setFlash('Información actualizada correctamente!.');
            }
        }
        $this->set("admin",$this->User->findById($id));
    }

    public function isAuthorized($user) {
        if(in_array($this->action, array('contact'))){
            return true;
        }
        if (isset($user['rol']) && $user['rol'] === 'Admin') {
            return true;
        }
        return false;
    }
}
?>