<?php

App::uses('AppController', 'Controller');
App::uses('Model', 'Adviser');
App::uses('Model', 'CreditTransaction');

class AccountController extends AppController {

	public $uses = array('Adviser','CreditTransaction');
	public $components = array('Account','Paginator');
        
        public $paginate = array(
            'limit' => 30,
            'recursive' => 4
            );

	public function assign(){
		$this->layout = "admin";
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

	public function isAuthorized($user) {
		if (isset($user['rol']) && $user['rol'] === 'Admin') {
	    return true;
	  }
	  return false;
	}
        
        public function creditsReport(){
            $this->layout = "admin";
            $advisers = $this->Paginator->paginate('Adviser');
            foreach($advisers as $key=>$adviser){
                $consumo = $this->CreditTransaction->find('count',array('fields' => 'CreditTransaction.id',
                    'conditions'=>array('CreditTransaction.account_id'=>$adviser['Account']['id'])));
                $advisers[$key]['Account']['consum'] = $consumo;
            }
            $this->set('advisers',$advisers);
        }

}

?>