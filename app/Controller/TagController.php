<?php

App::uses('AppController', 'Controller');

class TagController extends AppController {

	public $uses = array('InterestCategory');

	public function getTagsByCategory($categoryName = "general"){

		$this->layout = "ajax";
		$this->set('output', $this->InterestCategory->findByName($categoryName)['CategoryTag']);

	}

	public function isAuthorized($user) {
        return true;
    }

}
?>