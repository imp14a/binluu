<?php

App::uses('AppController', 'Controller');

class EventController extends AppController {

	public $components = array('BinluuEmail', 'Paginator');

	public $paginate = array(
        'limit' => 3,
        'recursive' => 4,
        'order' => array('Event.name' => 'asc'),
    );

	public function create(){
		$this->set('title_for_layout','Creación de eventos');
		$this->loadModel('AdviserProperty');
		$this->AdviserProperty->recursive = -1;
		$this->loadModel('Adviser');
		$adviser = $this->Adviser->find('first', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'))));
		$adviser_id = $adviser['Adviser']['id'];
		//PROPIEDADES
		$properties = $this->AdviserProperty->find('all', array('conditions'=>
			array('adviser_id'=>$adviser_id)));
		$enum = array();
		foreach ($properties as $property){
			$enum[$property['AdviserProperty']['id']] = $property['AdviserProperty']['description'];
		}
		$this->set('properties', $enum);
		//SEXO
		$this->loadModel('EventProfile');
		$sex = $this->EventProfile->getColumnType('sex');
		preg_match_all("/'(.*?)'/", $sex, $enums);
		unset($enum);
		foreach($enums[1] as $value )
  	{
      $enum[$value] = $value;
  	}
		$this->set('sex', $enum);	
		//SALVAR DATOS
		if(!empty($this->request->data)){
			$this->request->data['Event']['adviser_id'] = $adviser_id;
			if($this->Event->saveAll($this->request->data)){
        $this->redirect(array('controller'=>'Event','action' => 'inviteusers', $this->Event->getInsertID()));
      }else{
        $this->Session->setFlash("Ha ocurrido en error, intente de nuevo.");
      }
		}
	}

	public function inviteusers($event_id){
		$this->set('title_for_layout','Invitar usuarios a evento');
		$this->set('event_id', $event_id);
		$this->loadModel('EventProfile');
		$event_profile = $this->EventProfile->find('first', array('conditions'=>array('event_id'=>$event_id)));
		//Analizar usuarios a invitar
		$this->loadModel('Person');
		$this->Person->recursive = 2;
		$interests = array('OR'=>array());
		$no = 0;
		foreach (explode(' ', $event_profile['EventProfile']['interests']) as $interest) {
			$interests['OR'][$no++] = array('PersonProfile.interests LIKE' => '%'.$interest.'%');
		}
		$persons = $this->Person->find('all');
		$this->set('persons', $persons);
		if(!empty($this->request->data)){
			$this->loadModel('EventProfile');
			if($this->EventProfile->save($this->request->data)){
				$this->redirect(array('action'=>'eventCreated'));
			}
			//Determinar si hubo error y enviar notificación
		}
	}

	public function index(){
		$this->set('title_for_layout', 'Mis eventos');
		$this->Paginator->settings = $this->paginate;
		switch ($this->Session->read('Auth.User.rol')) {
			case 'Adviser':
				$this->loadModel('Adviser');
				$adviser = $this->Adviser->find('first', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'))));
				$adviser_id = $adviser['Adviser']['id'];
				$events = $this->Paginator->paginate('Event', array('Event.adviser_id' => $adviser_id,
					'Event.status !=' => 'canceled'));
				$aux_events = $this->Paginator->paginate('Event', array('Event.adviser_id' => $adviser_id,
					'Event.status !=' => 'canceled'));
				$no_events = 0;
				$this->loadModel('Request');
				$this->Request->recursive = 2;
				foreach ($aux_events as $event) {
					$guests = $this->Request->find('all', array(
					    'group' => array('Request.person_id'),
						'conditions'=>array('event_id'=>$event['Event']['id'])));
					$events[$no_events++]['Request']['Guests'] = $guests;
				}
				break;
			case 'Person':
				$this->loadModel('Person');
				$person = $this->Person->find('first', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'))));
				$person_id = $person['Person']['id'];
				$events = $this->Paginator->paginate('Request', array('Request.person_id'=>$person_id));
				$this->loadModel('Request');
				$aux_events = $this->Paginator->paginate('Request', array('Request.person_id'=>$person_id));
				$no_events = 0;
				$this->Request->recursive = 2;
				foreach ($aux_events as $event) {
					$guests = $this->Request->find('all', array(
					    'group' => array('Request.person_id'),
						'conditions'=>array('event_id'=>$event['Event']['id'],
						 'user_id !='=>$this->Session->read('Auth.User.id'))));
					$events[$no_events++]['Request']['Guests'] = $guests;
				}
				break;
		}		
		$this->set('events', $events);
	}

	public function view($secret_id){
		$event_id = is_numeric($secret_id) ? $secret_id : $this->BinluuEmail->getIdFromSecretId($secret_id);	
		$event = $this->Event->find('first', array('conditions'=>array('Event.id'=>$event_id)));
		$this->set('event', $event);
	}

	public function cancel($id){
		$this->Event->read(null, $id);
		$this->Event->set('status', 'canceled');
		$this->Event->save();
		$this->redirect(array('action'=>'index'));
	}

	public function eventCreated(){
		$this->set('title_for_layout', 'Evento creado');
	}

	public function isAuthorized($user) {
    if($this->action === 'index' && isset($user['rol']) && ($user['rol'] === 'Adviser' || $user['rol'] === 'Person')){
        return true;
    }
    if(isset($user['rol']) && $user['rol'] === 'Adviser'){
    	return true;
    }
    return false;
  }
}

?>