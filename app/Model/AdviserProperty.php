<?php

class AdviserProperty extends AppModel {

	public $name = 'AdviserProperty';

	public $hasMany = array('PropertyImage' => array(
		'conditions'=>array('PropertyImage.type' => 'description')));

	public $hasOne = array('DefaultImage' => array(
            'className' => 'PropertyImage',
            'conditions' => array('DefaultImage.type' => 'default')
    ));
	
}

?>