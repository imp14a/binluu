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

    public function register($step = 1) {
        $this->set('title_for_layout', 'Registro de usuarios');
        $this->set('captcha',$this->ReCaptcha->recaptcha_get_html("6LenjeoSAAAAAKnORAHl_6axBenfII6MBXD-UK9T"));
        $res = $this->InterestCategory->findByName('general');
        $resMedios = $this->InterestCategory->findByName('Medios de transporte');
        $resOcupacio = $this->InterestCategory->findByName('Ocupación');
        $this->set('tags', $res['CategoryTag']);
        $this->set('transports', $resMedios['CategoryTag']);
        $this->set('ocupations', $resOcupacio['CategoryTag']);
        $this->set('step',$step); 
        if (!empty($this->data)) {
            if($step==1){
                $data = $this->data;
                $data['User']['rol'] = "Person";
                $data['User']['active'] = 1;
                $data['PersonProfile']['min_budget'] = str_replace(",", "", str_replace("$", "",$data['PersonProfile']['min_budget']));
                $data['PersonProfile']['max_budget'] = str_replace(",", "", str_replace("$", "",$data['PersonProfile']['max_budget']));
                $resp = $this->ReCaptcha->recaptcha_check_answer ("6LenjeoSAAAAAHsL75gs1WwKnJXnROJP0LpSPk1e",
                                $_SERVER["REMOTE_ADDR"],
                                $this->data["recaptcha_challenge_field"],
                                $this->data["recaptcha_response_field"]);
                if(!$resp->is_valid){
                    $this->Session->setFlash("Ha ocurrido en error, intente de nuevo. (El texto introducido es incorrecto)");
                }else{
                    if ($this->Person->saveAssociated($data)) {
                        $this->set('step',2);
                        $this->set('person_id',$this->Person->getInsertID());
                    } else {
                        $this->Session->setFlash("Ha ocurrido en error, intente de nuevo. (Aún no seleccionas tu opción en mapa)");
                    }
                }
            }
            
        }elseif($step==2){
            //TODO guardamos las etiquetas
            $this->Session->setFlash('Registrado!, te hemos enviado un correo de confirmación para que puedas acceder.');
            $this->BinluuEmail->sendMail($this->User->getInsertID(), $data['User']['username'], CONFIRM_EMAIL_TYPE);
            $this->set("after_register");
            $this->redirect(array('controller' => 'User', 'action' => 'login'));
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
        if (in_array($this->action, array('home', 'edit', 'view')) && isset($user['rol']) && $user['rol'] === 'Person') {
            return true;
        }
        return false;
    }

    public function view($id){
        $this->set('title_for_layout', 'Perfil de usuario');
        $this->Person->recursive = 2;
        $this->set('person', $this->Person->read(null, $id));
    }

}

?>