<?php

App::uses('AppController', 'Controller');

class EventController extends AppController {

	public function create(){
		$this->set('title_for_layout','Creación de eventos');
		$this->loadModel('AdviserProperty');
		$this->AdviserProperty->recursive= -1;
		$adviser_id = 1;
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
			$this->request->data['Event']['adviser_id'] = 1;
			//$this->Session->read('Auth.User.id');
			if($this->Event->saveAll($this->request->data)){
                $this->Session->setFlash('Registrado!, tu evento se ha agregado con éxito.');
                $this->redirect(array('controller'=>'Adviser','action' => 'index'));
            }else{
                $this->Session->setFlash("Ha ocurrido en error, intente de nuevo.");
            }
		}
	}
}

?>