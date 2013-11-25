<?php

class PersonProfile extends AppModel {

	public $name = 'PersonProfile';

	public $hasAndBelongsToMany = array(
		'CategoryTag' => array(
            'className' => 'CategoryTag',
            'joinTable' => 'person_profile_tags',
            'foreignKey' => 'person_profile_id',
            'associationForeignKey' => 'category_tag_id'
    ));

	public $validate = array(
		'sex' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Campo requerido')
			),
		'ocupation'   => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Campo requerido')
			),
		'age' => array(
			'required' => array('rule' => array('minLength', '1'),
				'message' => 'Campo requerido')
			)
		);
}

?>