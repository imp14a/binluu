<?php

App::uses('AppController', 'Controller');

class RequestController extends AppController {

	public $components = array('BinluuEmail');

	public function view($id){
		$this->set('title_for_layout', 'Invitación');
		$request = $this->Request->find('first', array('conditions'=>array('Request.id'=>$id)));
		$this->set('request', $request);
	}

	public function confirm($id){
		$this->Request->read(null, $id);
		if($this->Request->field('status') === 'A'){
			$this->redirect($this->referer());
		}
		$this->Request->set(array(
			'status' => 'A'
		));
		$this->loadModel('Adviser');
		$event_id = $this->Request->data['Event']['adviser_id'];
		$adviser = $this->Adviser->find('first', array('conditions'=>array('Adviser.id'=>$event_id)));
		if($this->Request->save()){
			$this->BinluuEmail->sendMail($this->Session->read('Auth.User.id'),$adviser['User']['username'], ACCEPT_INVITE_EMAIL_TYPE, $event_id);
			$this->Session->setFlash('Asistencia confirmada!');
			$this->redirect($this->referer());
		}else{
			$this->Session->setFlash('Ha ocurrido un error, intente de nuevo');
		}
	}

	public function cancel($id){
		$this->Request->read(null, $id);
		if($this->Request->field('status') === 'C'){ 
			$this->redirect($this->referer());
		}
		$this->Request->set(array(
			'status' => 'C'
		));
		$this->loadModel('Adviser');
		$event_id = $this->Request->data['Event']['adviser_id'];
		$adviser = $this->Adviser->find('first', array('conditions'=>array('Adviser.id'=>$event_id)));
		if($this->Request->save()){
			$this->BinluuEmail->sendMail($this->Session->read('Auth.User.id'),$adviser['User']['username'], CANCEL_INVITE_EMAIL_TYPE, $event_id);
			$this->Session->setFlash('Asistencia confirmada!');
			$this->redirect($this->referer());
		}else{
			$this->Session->setFlash('Ha ocurrido un error, intente de nuevo');
		}
	}

	public function isAuthorized($user) {
    if(isset($user['rol']) && $user['rol'] === 'Person'){
      return true;
    }
    return false;
  }
}

?>