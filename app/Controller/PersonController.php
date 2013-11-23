<?php

App::uses('AppController', 'Controller');

class PersonController extends AppController {

    public $uses = array('Person', 'User', 'IdealProperty', 'PersonProfile','InterestCategory');
    public $components = array('BinluuEmail', 'BinluuImage', 'Paginator','ReCaptcha');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'User.name' => 'asc'
        )
    );

    public function index() {
        
    }

    public function home() {
        if ($this->Session->read('Auth.User.rol') != 'Person') {
            $this->Session->setFlash('No tienes permisos para acceder a esta opcion');
            $this->redirect(array('controller' => 'User', 'action' => 'home'));
        }
    }

    public function register() {
        $this->set('title_for_layout', 'Registro de usuarios');
        $this->set('captcha',$this->ReCaptcha->recaptcha_get_html("6LenjeoSAAAAAKnORAHl_6axBenfII6MBXD-UK9T"));
        $this->set('tags', $this->InterestCategory->findByName('general')['CategoryTag']);
        if (!empty($this->data)) {
            $data = $this->data;
            $data['User']['rol'] = "Person";
            $data['User']['active'] = 1;
            if ($this->Person->saveAssociated($data)) {
                $this->Session->setFlash('Registrado!, te hemos enviado un correo de confirmación para que puedas acceder.');
                $this->BinluuEmail->sendMail($this->User->getInsertID(), $data['User']['username'], CONFIRM_EMAIL_TYPE);
                $this->redirect(array('controller' => 'User', 'action' => 'login'));
            } else {
                $this->Session->setFlash("Ha ocurrido en error, intente de nuevo.");
            }
        }
    }

    public function edit($id = null) {

        $id = $id != null ? $id : $this->Session->read('Auth.User.id');

        if (!empty($this->data)) {
            $options = array('user_id' => $id);
            $p = $this->Person->find('first', $options);
            $data = $this->data;
            $data['User']['id'] = $id;
            $data['Person']['id'] = $p['Person']['id'];
            $data['PersonProfile']['id'] = $p['PersonProfile']['id'];
            $data['IdealProperty']['id'] = $p['IdealProperty']['id'];
            if ($this->Person->saveAssociated($data)) {
                $this->Session->setFlash('Información actualizada correctamente!.');
            } else {
                $this->Session->setFlash('Ha ocurrido un error, intente de nuevo.');
            }
        }

        $options = array('user_id' => $id);
        $this->set("person", $this->Person->find('first', $options));
    }

    public function listAll($status = null) {
        $this->Paginator->settings = $this->paginate;
        if ($status != null) {
            $users = $this->Paginator->paginate('Person', array('User.active' => $status));
        } else {
            $users = $this->Paginator->paginate('Person');
        }
        $this->set('users', $users);
    }

    public function isAuthorized($user) {
        if ($this->action === 'register') {
            return true;
        }
        if ($this->action === 'listAll' && isset($user['rol']) && $user['rol'] === 'Admin') {
            return true;
        }
        if (in_array($this->action, array('home', 'edit')) && isset($user['rol']) && $user['rol'] === 'Person') {
            return true;
        }
        return false;
    }

}

?>