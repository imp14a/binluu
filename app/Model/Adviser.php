<?php

class Adviser extends AppModel {

	public $name = 'Adviser';

	public $hasOne = "Account";

	public $hasMany = array("AdviserProperty",'Event');

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
	
}

?>