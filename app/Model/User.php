<?php

class User extends AppModel {

	public $name = 'User';
	public $hasMany = "Mail";

	public $validate = array(
		'name' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Nombre de usuario obligatorio')),
                'last_name' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Los apellidos son obligatorios')),
		'password'   => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Contraseña obligatoria'),
			'length' => array('rule' => array('minLength', 6),
				'message' => 'La longitud mínima de la contraseña es de 6 caracteres'),
			'valid' => array('rule' => array('checkpasswords'),
				'message' => 'Las contraseñas deben coincidir')
			),
		'username' => array(
			'valid' => array('rule' => array('checkemail'),
				'message' => 'El email que desea agregar ya existe')
			)
		);

    public function checkpasswords()
    {
        return strcmp($this->data['User']['password'],$this->data['User']['password_confirm']) == 0;
    }

    public function checkemail()
    {
        $username = $this->find('count', array(
            'conditions' => array('username' => $this->data['User']['username']),
            'recursive' => -1));
        return $username === 0;
    }
    public function beforeSave($options = null) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
    
    public function faq(){
        
    }
}

?>