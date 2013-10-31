<?php

App::uses('AppController', 'Controller');


class TestController extends AppController {

	public $components = array('BinluuEmail');

	public function index(){
		$this->title = "Bienvenido!";
		$this->BinluuEmail->sendMail(1,'rgarcia.cejudo@gmail.com',CONFIRM_EMAIL_TYPE);

	}
}
?>