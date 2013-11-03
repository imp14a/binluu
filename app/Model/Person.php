<?php

class Person extends AppModel {

	public $name = 'Person';
	public $useTable = "persons";

	public $hasOne = array("PersonProfile","IdealProperty");
	//public $hasMany = array("IdealProperty");

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
	
}

?>