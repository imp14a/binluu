<?php

class PersonProfile extends AppModel {

	public $name = 'PersonProfile';

	public $validate = array(
		'sex' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Campo requerido')
			),
		'ocupation'   => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Campo requerido')
			),
		'age' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Campo requerido')
			)
		);
}

?>