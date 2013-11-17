<?php

class Request extends AppModel {

	public $name = 'Request';

	public $belongsTo = array(
        'Person' => array(
            'className' => 'Person',
            'foreignKey' => 'person_id'
        ),
        'Event' => array(
        		'className' => 'Event',
        		'foreignKey' => 'event_id'
        )
    );
	
}

?>