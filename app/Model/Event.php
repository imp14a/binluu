<?php

class Event extends AppModel {

	public $name = 'Event';

	public $hasMany = array('Request');

	public $hasOne = "EventProfile";
	
	public $belongsTo = array(
        'Adviser' => array(
            'className' => 'Adviser',
            'foreignKey' => 'adviser_id'
        )/*,
        'Event' => array(
        		'className' => 'Event',
        		'foreignKey' => 'event_id'
        )*/
    );
}

?>