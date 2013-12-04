<?php

class Event extends AppModel {

	public $name = 'Event';

	public $hasMany = array('Request');

	public $hasOne = "EventProfile";
	
	public $belongsTo = array(
        'Adviser' => array(
            'className' => 'Adviser',
            'foreignKey' => 'adviser_id'
        ),
        'AdviserProperty' => array(
        		'className' => 'AdviserProperty',
        		'foreignKey' => 'property_id'
        )
    );
    
   public $validate = array(
		'name' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Nombre de evento obligatorio')),
        'property_description' => array(
            'required' => array('rule' => array('minLength', '1'),
                'message' => 'Descripción obligatoria')),		
		);
}

?>