<?php

class PropertyImage extends AppModel {

	public $name = 'PropertyImage';

	public $validate = array(
		'image' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Imagen obligatoria'))
		);
	
}

?>