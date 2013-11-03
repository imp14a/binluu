<?php

App::uses('AppController', 'Controller');

class EventController extends AppController {

	public function create(){
		$this->set('title_for_layout','Creación de eventos');
		if(!empty($this->request->data)){
			$this->request->data['Event']['adviser_id'] = $this->Session->read('Auth.User.id');
			//TODO: DEterminar la propiedad de la cual se creará el evento	
			if($this->Event->save($this->request->data)){
                $this->Session->setFlash('Registrado!, tu evento se ha agregado con éxito.');
                $this->redirect(array('controller'=>'Adviser','action' => 'index'));
            }else{
                $this->Session->setFlash("Ha ocurrido en error, intente de nuevo.");
            }
		}
	}

	public function beforeFilter(){
		$this->Auth->allow('create');
	}
}

?>