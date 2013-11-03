<?php

App::uses('AppController', 'Controller');


class TestController extends AppController {

	public $components = array('BinluuEmail', 'BinluuImage');

	public function index(){
		$this->title = "Bienvenido!";
		//$this->BinluuEmail->sendMail(4,'ricardo_soulost@hotmail.com',CONFIRM_EMAIL_TYPE);
		/*if(!empty($this->request->data)){
			$this->BinluuImage->saveImage(4,$this->request->data['User']['image_file']);
		}*/
		//var_dump($this->BinluuImage->getDefaultImage('F'));
	}

	public function beforeFilter(){
		$this->Auth->allow('index');
	}
}
?>