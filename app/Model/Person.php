<?php

class Person extends AppModel {

	public $name = 'Person';

	public $hasOne = array("PersonProfile");
	public $hasMany = array("IdealProperty");

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
	
}

?>