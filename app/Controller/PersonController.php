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

    public function register($step = 1,$person_profile_id=null) {
        $this->set('title_for_layout', 'Registro de usuarios');
        $this->set('captcha',$this->ReCaptcha->recaptcha_get_html("6LenjeoSAAAAAKnORAHl_6axBenfII6MBXD-UK9T"));
        $res = $this->InterestCategory->findByName('Intereses');
        $resMedios = $this->InterestCategory->findByName('Medio de transporte');
        $resOcupacio = $this->InterestCategory->findByName('Ocupación');
        $this->set('tags', $res['CategoryTag']);
        $this->set('transports', $resMedios['CategoryTag']);
        $this->set('ocupations', $resOcupacio['CategoryTag']);
        $this->set('step',$step);
        if($person_profile_id!=null){
            $this->set('person_profile_id',$person_profile_id);
            //TODO poner el user_profile_id
        }
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
                        $this->redirect(array("controller"=>"Person","action"=>"register",2,$this->PersonProfile->getLastInsertID()));
                    } else {
                        $this->Session->setFlash("Ha ocurrido en error, intente de nuevo. (Aún no seleccionas tu opción en mapa)");
                    }
                }
            }elseif($step==2){
                $data = $this->data;
                foreach($data['PersonProfileTag'] as $key=>$val){
                    $data['PersonProfileTag'][$key]['person_profile_id'] = $data['PersonProfile']['id'];
                }
                $this->PersonProfile->saveAll($this->data);
                $person = $this->Person->findByUserId($this->data['PersonProfile']['id']);
                //debug($person);
                //$this->Session->setFlash('Registrado!, te hemos enviado un correo de confirmación para que puedas acceder.');
                $this->BinluuEmail->sendMail($person['User']['id'], $person['User']['username'], CONFIRM_EMAIL_TYPE);
                $this->set("after_register");
                $this->redirect(array('controller' => 'User', 'action' => 'login',"after_register"));
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
        
        $options = array('conditions'=>array('user_id' => $id));
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
        if($this->action === 'getPersonsByProfile' && isset($user['rol']) && $user['rol'] === 'Adviser'){
            return true;
        }
        return false;
    }

    public function view($id){
        $this->set('title_for_layout', 'Perfil de usuario');
        $this->Person->recursive = 2;
        $this->set('person', $this->Person->read(null, $id));
    }

    public function getPersonsByProfile(){
        $this->layout = 'ajax';
        $conditions = array();
        $age = utf8_decode(isset($_REQUEST['age']) ? $_REQUEST[ 'age' ] : null);
        $ocupation = utf8_decode(isset($_REQUEST['ocupation']) ? $_REQUEST[ 'ocupation' ] : null);
        $sex = utf8_decode(isset($_REQUEST['sex']) ? $_REQUEST[ 'sex' ] : null);
        $transport = utf8_decode(isset($_REQUEST['transport']) ? $_REQUEST[ 'transport' ] : null);
        $minBudget = utf8_decode(isset($_REQUEST['minBudget']) ? $_REQUEST[ 'minBudget' ] : null);
        $maxBudget = utf8_decode(isset($_REQUEST['maxBudget']) ? $_REQUEST[ 'maxBudget' ] : null);
        if($age!=null) array_push($conditions, array('PersonProfile.age'=>$age));
        if($ocupation!=null) array_push($conditions, array('PersonProfile.ocupation'=>$ocupation));
        if($sex!=null && $sex!='N') array_push($conditions, array('PersonProfile.sex'=>$sex));
        if($transport!=null) array_push($conditions, array('PersonProfile.transport'=>$transport));
        //if($minBudget!=null) array_push($conditions, array('PersonProfile.min_budget BETWEEN ? AND ?'=>array($minBudget, $maxBudget)));
        //if($maxBudget!=null) array_push($conditions, array('PersonProfile.max_budget BETWEEN ? AND ?'=>array($minBudget, $maxBudget)));
        if(count($conditions) > 0){
            $persons = $this->Person->find('all', array(
                    'conditions'=> $conditions
                )
            );
        }else{
            $persons = $this->Person->find('all');
        }
        $this->set('output', json_encode($persons));
    }

}

?>