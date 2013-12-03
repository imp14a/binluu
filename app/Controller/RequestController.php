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

	public function isPersonInvited(){
		$this->layout = 'ajax';
		$personID = utf8_decode(isset($_REQUEST['personID']) ? $_REQUEST[ 'personID' ] : '');
		$eventID = utf8_decode(isset($_REQUEST['eventID']) ? $_REQUEST[ 'eventID' ] : '');
		$out = $this->Request->find('all', array(
			'conditions'=>array('Request.person_id'=>$personID,
				'Request.event_id'=>$eventID),
			'fields'=>array('Request.notified_by_mail')
		));
		$this->set('output', $out[0]['Request']);
	}

	public function invitePerson(){
		$this->layout = 'ajax';
		$personID = utf8_decode(isset($_REQUEST['personID']) ? $_REQUEST[ 'personID' ] : '');
		$eventID = utf8_decode(isset($_REQUEST['eventID']) ? $_REQUEST[ 'eventID' ] : '');
		$data = array();
		$data['Request']['person_id'] = $personID;
		$data['Request']['event_id'] = $eventID;
		$data['Request']['date'] = date('Y-m-d');
		$this->loadModel('Person');
		$adviser_id = $this->Session->read('Auth.User.id');
		$person = $this->Person->find('first', array('conditions'=>array('Person.id'=>$personID)));
		if(!$this->BinluuEmail->sendMail($adviser_id, $person['User']['username'], INVITE_EMAIL_TYPE, $eventID)){
			//Agregar error
			$data['Request']['notified_by_mail'] = 0;
		}else{
			//Actualizar campo notified_by_email
			$data['Request']['notified_by_mail'] = 1;
		}
		if($this->Request->save($data)){
			$this->set('output', true);
		}else{
			$this->set('output', false);
		}
	}

	public function isAuthorized($user) {
    if(isset($user['rol']) && $user['rol'] === 'Person'){
      return true;
    }
    if(isset($user['rol']) && $user['rol'] === 'Adviser' && in_array($this->action, array('isPersonInvited', 'invitePerson'))){
      return true;
    }
    return false;
  }
}

?>