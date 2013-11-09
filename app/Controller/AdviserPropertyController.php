<?php

App::uses('AppController', 'Controller');

class AdviserPropertyController extends AppController {

	public $components = array('BinluuImage');

	public function index($adviser_id = null){
		$this->set('title_for_layout','Propiedades');
		
		if($adviser_id === null)
			$this->set('properties', $this->AdviserProperty->find('all'));
		else
			$this->set('properties', $this->AdviserProperty->find('all', array(
				'conditions'=>array('adviser_id'=>$adviser_id))));
	}

	public function add(){
		$this->set('title_for_layout', 'Agregar propiedad');
		if(!empty($this->request->data)){
			$default = $this->request->data['DefaultImage']; 
			$images = $this->request->data['PropertyImage'];
			$ok = $this->BinluuImage->uploadImage($default['image']['name'], $default['image']);
			if($ok){
				$this->request->data['DefaultImage']['image'] = $default['image']['name'];
			}
			$no = 0;
			foreach ($images as $image) {
				$ok = $this->BinluuImage->uploadImage($image['image']['name'], $image['image']);
				if($ok){
					$this->request->data['PropertyImage'][$no]['image'] = $image['image']['name'].'_'.$no;
					$no++;
				}
			}
			if(!$ok){
				$this->Session->setFlash('Ha ocurrido un error al subir las imágenes.');	
			}else if($this->AdviserProperty->saveAll($this->request->data)){
				$this->Session->setFlash('Propiedad registrada!');
				return $this->redirect($this->referer());
			}else{
				$this->Session->setFlash('No se pudo registrar la propiedad.');
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
	        $this->AdviserProperty->id = $id;
	        $this->request->data['AdviserProperty']['adviser_id'] = 1;
			$default = $this->request->data['DefaultImage']; 
			$ok = true;
			if($default['image']['name'] != ''){
				$ok = $this->BinluuImage->uploadImage($default['image']['name'], $default['image']);
				if($ok){
					$this->request->data['DefaultImage']['image'] = $default['image']['name'];
				}
			}else{
				unset($this->request->data['DefaultImage']);
			}
			$images = $this->request->data['PropertyImage'];
			$no = 0;
			foreach ($images as $image) {
				if($image['image']['name'] != ''){
					$ok = $this->BinluuImage->uploadImage($image['image']['name'], $image['image']);
					if($ok){
						$this->request->data['PropertyImage'][$no]['image'] = $image['image']['name'].'_'.$no;						
					}	
				}else{
					unset($this->request->data['PropertyImage'][$no]);
				}
				$no++;
			}
			if(!$ok){
				$this->Session->setFlash('Ha ocurrido un error al subir las imágenes.');	
			}else if($this->AdviserProperty->saveAll($this->request->data)){
				$this->Session->setFlash('Propiedad actualizada!');
				return $this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash('No se pudo actualizar la propiedad.');
			}
	    }

	    if (!$this->request->data) {
	    	$this->set('property', $property);
	        $this->request->data = $property;
    	}
	}

	public function delete($id){
		if (!$this->request->is('post')) {
            throw new MethodNotAllowedException('No puedes eliminar la propiedad');
        }
        if ($this->AdviserProperty->delete($id)) {
            $this->Session->setFlash('Propiedad eliminada.');
            $this->redirect(array('action' => 'index'));
        }else{
            $this->Session->setFlash('Ha ocurrido un error al tratar de eliminar, intente de nuevo.');
        }
	}

}