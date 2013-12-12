<?php

App::import('Model','Account');
App::import('Model','CreditTransaction');

class AccountComponent extends Component {

	public $errorMessaje;

	public function assignCredits($account_id,$quantity){

		if($quantity>0 && $account_id!=null){

			$a = new Account();
			$account = $a->find('first',array('id'=>$account_id));

			if(!empty($account)){
				$ct = new CreditTransaction();
				$ctds = $ct->getDataSource();
				$ctds->begin();

				$ct->save(array('account_id'=>$account_id,"quantity"=>$quantity,'date'=>DboSource::expression('NOW()')));
				$a->id = $account['Account']['id'];
				if($a->saveField('credits',(int)$quantity + (int)$account['Account']['credits'])){
					$ctds->commit();
				}
				else{
					$ctds->rollback();
					$this->errorMessaje = "No se pudo asignar los créditos.";
					return false;
				}
			}else{
				$this->errorMessaje = "La cuenta destino no existe.";
				return false;
			}
		}else{
			$this->errorMessaje = "Los datos de la cuenta destino son erroneos.";
			return false;
		}
		return true;
		
	}

	public function consumeCredit($adviser_id){
		$a = new Account();
		$account = $a->find('first',array('adviser_id'=>$adviser_id));
		if(empty($account)){
			$this->errorMessaje = 'La cuenta no existe';
			return false;
		}
		if($account['Account']['credits']==0){
			$this->errorMessaje = 'No cuentas con créditos suficientes para realizar la transacción';
			return false;
		}
		$a->id = $account['Account']['id'];
		return $a->saveField('credits',(int)$account['Account']['credits'] - 1);
	}
}

?>