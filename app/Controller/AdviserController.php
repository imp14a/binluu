<?php

App::uses('AppController', 'Controller');

class AdviserController extends AppController {

    public $uses = array('Adviser','User');
    public $components = array('BinluuEmail', 'Paginator');

    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'User.name' => 'asc'
        )
    );

    public function index(){
        if($this->Session->read('Auth.User.rol')!='Adviser'){
            $this->Session->setFlash('No tienes permisos para acceder a esta opcion');
            $this->redirect(array('controller'=>'User','action'=>'home'));
        }
    }

    public function register(){
        $this->set('title_for_layout','Registro de usuarios');
        if (!empty($this->data)) {
            $data = $this->data;
            $data['User']['rol'] = "Adviser";
            $data['User']['active'] = 1;
            $data['Account']['status'] = "A";
            $data['Account']['credits'] = 0;

            if($this->Adviser->saveAssociated($data)){
                $this->Session->setFlash('Registrado!, le hemos enviado un correo de confirmación para que puedas acceder.');
                /*$this->BinluuEmail->sendAdviserConfirmMail($this->User->getInsertID(),$data['User']['username'],
                    $data['User']['password']);
                $this->redirect(array('controller'=>'User','action' => 'login'));
                */
               $this->redirect(array("controller"=>"User","action"=>"home"));
            }else{
                $this->Session->setFlash("Ha ocurrido en error, intente de nuevo.");
            }
        }
    }

    public function contact(){
        $this->set('contact_info_send',false);       
        if(!empty($this->data)){
            $this->BinluuEmail->sendConfirmMail($this->data['Contact']['name'],$this->data['Contact']['email'],$this->data['Contact']['phone'],$this->data['Contact']['message']);
            $this->set('contact_info_send',true);
        }
    }

    public function edit( $id = null){

        $id = $id!=null?$id:$this->Session->read('Auth.User.id');
        
        if(!empty($this->data)){
            $options = array('user_id'=>$id);
            $p = $this->Adviser->find('first',$options);
            $data = $this->data;
            $data['User']['id'] = $id;
            $data['Adviser']['id'] = $p['Adviser']['id'];
            if($this->Adviser->saveAssociated($data)){
                $this->Session->setFlash('Información actualizada correctamente!.');
            }
        }
        $options = array('conditions'=> array('user_id'=>$id));
        $this->set("adviser",$this->Adviser->find('first',$options));
    }

    public function listAll($status = null){
        $this->Paginator->settings = $this->paginate;
        if($status!=null){
            $users = $this->Paginator->paginate('Adviser', array('User.active' => $status));
        }else{
            $users = $this->Paginator->paginate('Adviser');
        }
        $this->set('users', $users);
    }

    public function isAuthorized($user) {
        if($this->action === 'contact'){
            return true;
        }
        if($this->action === 'listAll' && isset($user['rol']) && $user['rol'] === 'Admin'){
            return true;
        }
        if($this->action != 'listAll' && isset($user['rol']) && $user['rol'] === 'Adviser'){
            return true;
        }
        return false;
    }
}
?>