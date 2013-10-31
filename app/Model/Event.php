<?php

class Event extends AppModel {

	public $name = 'Event';

	public $hasMany = array('Request');

	public $hasOne = "EventProfile";
	
}

?>