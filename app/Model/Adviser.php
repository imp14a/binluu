<?php

class Adviser extends AppModel {

	public $name = 'Adviser';

	public $hasOne = "Acount";

	public $hasMany = array("AdviserProperty","CreditTransaction",'Event');

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
	
}

?>