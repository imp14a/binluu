<?php 

define('CONFIRM_EMAIL_TYPE', 0);
define('INVITE_EMAIL_TYPE', 1);
define('ACCEPT_INVITE_EMAIL_TYPE', 2);
define('CANCEL_INVITE_EMAIL_TYPE', 3);
define('CANCEL_EVENT_EMAIL_TYPE', 4);

App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class BinluuEmailComponent extends Component {
    
	/**
	 * Sistema de notificaciones para eventos y confirmación de correos, 
	 * por medio de mails.
	 * @param  [int] 	$user_from_id [id del usuario que envía el email]
	 * @param  [string] $user_to      [usuario destinatario]
	 * @param  [int] 	$email_type   [tipo de email a enviar]
	 * @param  [int] 	$event_id     [id del evento involucrado (opcional)]
	 * @return [null]               
	 */
    public function sendMail($user_from_id, $user_to, $email_type, $event_id = null) {
    	$message = "";
    	$subject = "";
    	$user = ClassRegistry::init('User');
    	$event = ClassRegistry::init('Event');
    	$user_db = $user->findById($user_from_id);
    	if ($event_id != null && $email_type != CONFIRM_EMAIL_TYPE)
    		$event_db = $event_db->findById($event_id);
    	switch ($email_type) {
    		case CONFIRM_EMAIL_TYPE:
    		    $subject = 'Confirmación de correo';
    			$link = "http://".$_SERVER['HTTP_HOST']."/index.php/User/confirm/".urlencode($this->getSecretUserId($user_from_id));
    			$message = 'Hola, ' . utf8_encode($user_db['User']['name']) . ', para confirmar tu correo da clic en la siguiente dirección: ' . $link;        
    			break;
    		case INVITE_EMAIL_TYPE:
    			$subject = 'Te han invitado a un evento';
    			$link = "http://".$_SERVER['HTTP_HOST']."/index.php/User/confirm/".urlencode($this->getSecretUserId($user_from_id));
    			$message = "El usuario ".$user_db['User']['name']." te ha invitado a asistir al evento ".$event_db['Event']['name'].".";   			
    			break;
    		case ACCEPT_INVITE_EMAIL_TYPE:
    			$subject = 'Han aceptado una invitación';
    			$link = "http://".$_SERVER['HTTP_HOST']."/index.php/User/confirm/".urlencode($this->getSecretUserId($user_from_id));
    			$message = "El usuario ".$user_db['User']['name']." ha confirmado su asistencia al evento ".$event_db['Event']['name'].".";   			
    			break;
    		case CANCEL_INVITE_EMAIL_TYPE:
    		    $subject = 'Han cancelado una invitación';
    		    $link = "http://".$_SERVER['HTTP_HOST']."/index.php/User/confirm/".urlencode($this->getSecretUserId($user_from_id));
    		    $message = "El usuario ".$user_db['User']['name']." ha cancelado su asistencia al evento ".$event_db['Event']['name'].".";   			
    			break;
    		case CANCEL_EVENT_EMAIL_TYPE:
    		    $subject = 'Han cancelado un evento'; 
    		    $message = "Se ha cancelado el evento ".$event_db['Event']['name'].".";   			
    			break;    		
    	}
        /*$email = new CakeEmail('binluumail');
        $email->from($user_db['User']['username']);
        $email->to($user_to);
        $email->subject($subject);
        $email->send($message);*/
    }

    public function getSecretUserId($id){
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $encrypted = Security::rijndael(intval($id), $key, 'encrypt');
        return strtr(base64_encode($encrypted), '+/=', '-_,');
    }


}

?>