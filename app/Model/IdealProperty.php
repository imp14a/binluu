<?php

class IdealProperty extends AppModel {

	public $name = 'IdealProperty';

	public $validate = array(
		'latitude' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Necesitas seleccionar una ubicación')
			),
		'longitude'   => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Necesitas seleccionar una ubicación')
			)
		);
	
}

?>