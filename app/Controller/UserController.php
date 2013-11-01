<?php

App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
App::uses('Model', 'User');

class UserController extends AppController {

	public $uses = array('User');

	public function home() {

	}

	public function login() {
        $this->set('title_for_layout','Ingresa');
        if($this->Session->read('Auth.User')) $this->redirect(array('controller'=>'User','action'=>'home'));
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

    public function password($id = null){
        $id = $id!=null?$id:$this->Session->read('Auth.User.id');
        if(!empty($this->data)){
        	$data = $this->data;
        	$data['User']['id'] = $id;
	        $this->User->save($data);
	        $this->redirect(array('controller'=>'User','action'=>'edit'));
        }
    }
}
?>