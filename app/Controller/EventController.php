<?php

App::uses('AppController', 'Controller');

class EventController extends AppController {

	public $components = array('BinluuEmail', 'Paginator', 'BinluuImage');

	public $paginate = array(
        'limit' => 3,
        'recursive' => 4,
        'order' => array('Event.name' => 'asc'),
    );

	public function create(){
		$this->set('title_for_layout','Creación de eventos');
		//SALVAR DATOS
		$this->loadModel('Adviser');
		$adviser = $this->Adviser->find('first', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'))));
		$adviser_id = $adviser['Adviser']['id'];
		if(!empty($this->request->data)){

			$this->request->data['AdviserProperty']['adviser_id'] = $adviser_id;
			$this->request->data['AdviserProperty']['latitude'] = '19.161819869398563';
			$this->request->data['AdviserProperty']['longitude'] = '-99.6160951629281';
			$this->request->data['Event']['adviser_id'] = $adviser_id;
			$this->loadModel('AdviserProperty');
			$no = 0;
			foreach ($this->request->data['PropertyImage'] as $image) {
				$ok = $this->BinluuImage->uploadImage($image['image']['name'], $image['image']);
				if($ok){
					$this->request->data['PropertyImage'][$no]['image'] = $image['image']['name'];
					$no++;
				}
			}
			if($this->AdviserProperty->saveAll($this->request->data, array('validate'=>'only'))){
				$this->request->data['Event']['property_id'] = $this->AdviserProperty->getInsertID();
				if($this->Event->save($this->request->data)){
					$this->redirect(array('controller'=>'Event','action' => 'inviteusers', $this->Event->getInsertID()));
				}else{
        	$this->Session->setFlash("Ha ocurrido en error, intente de nuevo.");
      	}
      }else{
      	$errors = $this->AdviserProperty->invalidFields(); 
      	if(count($errors)>0){
      		$this->Session->setFlash("Asegúrese de llenar todos los campos.");
      	}else{
					$this->Session->setFlash("Ha ocurrido en error, intente de nuevo.");
      	}
      }
		}
	}

	public function inviteusers($event_id){
		$this->set('title_for_layout','Invitar usuarios a evento');
		$this->set('event_id', $event_id);
		$this->loadModel('EventProfile');
		$this->loadModel('InterestCategory');
		$this->InterestCategory->recursive = 2;
		$aux = $this->InterestCategory->find('all', array(
			'conditions'=>array('InterestCategory.name'=>'Medio de transporte')));
		if(!empty($this->request->data)){
			$this->loadModel('EventProfile');
			$this->request->data['EventProfile']['event_id'] = $event_id;
			$minBudget = $this->request->data['EventProfile']['min_budget'];
			$minBudget = preg_replace('/[^\d\.]/', '', $minBudget);
			$this->request->data['EventProfile']['min_budget'] = $minBudget;
			$maxBudget = $this->request->data['EventProfile']['max_budget'];
			$maxBudget = preg_replace('/[^\d\.]/', '', $maxBudget);
			$this->request->data['EventProfile']['max_budget'] = $maxBudget;
			if($this->EventProfile->save($this->request->data)){
				$this->redirect(array('action'=>'eventCreated'));
			}else{
				$this->Session->setFlash('Ha ocurrido un error, intente más tarde.');
			}
		}
		$enum = array();
		array_push($enum, array('N'=>'Medio de transporte'));
		foreach ($aux[0]['CategoryTag'] as $tag) {
			$enum[$tag['name']] = $tag['name'];
		}
		$this->set('transports', $enum);
		unset($enum);
		$aux = $this->InterestCategory->find('all', array(
			'conditions'=>array('InterestCategory.name'=>'Ocupación')));
		$enum = array();
		array_push($enum, array('N'=>'Ocupación'));
		foreach ($aux[0]['CategoryTag'] as $tag) {
			$enum[$tag['name']] = $tag['name'];
		}
		$this->set('ocupations', $enum);
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
				$this->Request->recursive = 3;
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