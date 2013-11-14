<?php

class InterestCategory extends AppModel {

	public $name = 'InterestCategory';

	public $hasMany = array('CategoryTag');
	
}

?>