<?php

App::uses('AppController', 'Controller');

class AdviserPropertyController extends AppController {

	public function index(){
		$this->set('title_for_layout','Propiedades');
		$this->set('properties', $this->AdviserProperty->find('all'));
	}

	public function add(){
		$this->set('title_for_layout', 'Agregar propiedad');
		if(!empty($this->request->data)){
			if($this->AdviserProperty->saveAll($this->request->data, array('validate'=>'first'))){
				$this->Session->setFlash('Propiedad registrada.');
				$this->redirect(array('action' => 'index'));					
			}else{
				$this->Session->setFlash('Ha ocurrido un error, por favor intente más tarde');
			}	
		}
	}

	public function edit($id){
		if (!$id) {
	        throw new NotFoundException('Propiedad inválida');
	    }

	    $property = $this->AdviserProperty->findById($id);
	    if (!$property) {
	        throw new NotFoundException('Propiedad inválida');
	    }

	    if ($this->request->is(array('post', 'put'))) {
	        $this->Post->id = $id;
	        if ($this->AdviserProperty->saveAll($this->request->data)) {
	            $this->Session->setFlash('Propiedad actualizada!');
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash('No se pudo actualizar la propiedad.');
	    }

	    if (!$this->request->data) {
	        $this->request->data = $property;
    	}
	}

}