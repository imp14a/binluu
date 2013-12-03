<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('Model', 'User');

class UserController extends AppController {

	public $uses = array('User');
    public $components = array('BinluuImage');

	public function home() {
        switch($this->Session->read('Auth.User.rol')){
            case 'Admin':
                $this->redirect(array('controller'=>'Admin'));
            break;
            case 'Adviser':
                $this->redirect(array('controller'=>'Event'));
            break;
            default:
                $this->redirect(array('controller'=>'Event'));
            break;
        }
	}

	public function login($type=null) {
        $this->set('title_for_layout','Ingresa');
        if($this->Session->read('Auth.User')) $this->redirect(array('controller'=>'User','action'=>'home'));
        if($type!=null){
            $this->set($type,1);
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
            	$this->User->id = $this->Session->read('Auth.User.id');
            	$this->User->saveField('last_login',DboSource::expression('NOW()'));
                $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash('Usuario o contraseña incorrectos, intente de nuevo.');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function delete($id = null){
        $id = $id!=null?$id:$this->Session->read('Auth.User.id');
        $this->User->id = $id;
        $this->User->saveField('active',0);
        $this->logout();
    }

    public function password($redirectTo = 'Person', $id = null){
        $id = $id!=null?$id:$this->Session->read('Auth.User.id');
        if(!empty($this->data)){
        	$data = $this->data;
        	$data['User']['id'] = $id;
	        $this->User->save($data);
            $this->Session->setFlash('Contraseña actualizada correctamente.');
	        $this->redirect(array('controller'=>$redirectTo,'action'=>'edit'));
        }
    }

    public function image($redirectTo = 'Person', $id = null){
        $id = $id!=null?$id:$this->Session->read('Auth.User.id');
        $size = 128;
        if(!empty($this->data)){
            $data = $this->data;
            $data['User']['id'] = $id;
            $this->BinluuImage->saveImage($id, $data['User']['image']);
            $data['User']['image'] = $this->BinluuImage->thumb($id, $size);
            
            $this->Session->setFlash('Imagen actualizada correctamente.');
            $this->redirect(array('controller'=>$redirectTo,'action'=>'edit'));
        }

    }

    public function activate($id){
        if (!$this->request->is('post')) {  
            return;
        }
        $this->User->id = $id;
        $user_db = $this->User->read();
        $user_db['User']['active'] = !$user_db['User']['active'];
        if($this->User->save($user_db, false)){
            $this->Session->setFlash('Usuario actualizado!');
            $this->redirect($this->referer());
        } 
        else{
            $this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
        }
    }

    public function isAuthorized($user) {
        if($this->action === 'login'){
            return true;
        }
        if(isset($user['rol']) && in_array($this->action, array('password', 'image', 'logout', 'home'))){
            return true;
        }
        if($this->action === 'delete' && isset($user['rol']) && ($user['rol'] === 'Person' || $user['rol'] === 'Adviser')){
          return true;
        }
        if($this->action === 'activate' && isset($user['rol']) && $user['rol'] === 'Admin'){
            return true;
        }
        return false;
    }

}
?>