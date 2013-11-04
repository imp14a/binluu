<?php

App::uses('AppController', 'Controller');
App::uses('Model', 'Adviser');

class AccountController extends AppController {

	public $uses = array('Adviser');

	public $components = array('Account');

	public function assign(){
		
		if(!empty($this->data)){
			$adviser = $this->Adviser->find('first',array('conditions'=>array('User.username'=>$this->data['Account']['username'])));
			if(!empty($adviser)){
				if($this->Account->assignCredits($adviser['Account']['id'],$this->data['Account']['quantity'])){
					$this->Session->setFlash('Asignación de creditos realizada correctamente');
				}else{
					$this->Session->setFlash('Error: '.$this->Account->errorMessaje);
				}
				$this->redirect(array('controller'=>'Admin'));
			}
			else{
				$this->Session->setFlash('El usuario no es promotor');
				$this->redirect(array('controller'=>'Admin'));	
			}
		}
	}

}

?>