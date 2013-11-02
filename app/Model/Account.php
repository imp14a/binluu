<?php

class Account extends AppModel {

	public $name = 'Account';

	public $hasMany= array("CreditTransaction");
	
}

?>