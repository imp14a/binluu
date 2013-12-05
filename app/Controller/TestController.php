<?php

App::uses('AppController', 'Controller');
App::import('Model', 'IdealProperty');
App::import('Model', 'AdviserProperty');


class TestController extends AppController {

	public $components = array('BinluuEmail', 'BinluuImage');

	public function index(){
		$this->title = "Bienvenido!";
		//$this->BinluuEmail->sendMail(4,'ricardo_soulost@hotmail.com',CONFIRM_EMAIL_TYPE);
		/*if(!empty($this->request->data)){
			$this->BinluuImage->saveImage(4,$this->request->data['User']['image_file']);
		}*/
		//var_dump($this->BinluuImage->getDefaultImage('F'));
		var_dump($this->BinluuImage->thumb(2, 128));
	}

	public function beforeFilter(){
		$this->Auth->allow('index','userMap');
	}

	public function getUsers(){
		$this->loadModel('User');
		$this->layout = "ajax";
		$out = array();
		foreach($this->User->find('all') as $res){
			array_push($out, utf8_encode($res['User']['username']));
		}
		$this->set('output', $out);
	}
        
        public function userMap(){
            $ip = new IdealProperty();
            $ap = new AdviserProperty();
            $this->set('ideal_properties',$ip->find('all'));
            $this->set('adviser_properties',$ap->find('all'));
        }
}
?>