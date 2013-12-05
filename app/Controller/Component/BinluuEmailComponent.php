<?php 

define('CONFIRM_EMAIL_TYPE', 0);
define('INVITE_EMAIL_TYPE', 1);
define('ACCEPT_INVITE_EMAIL_TYPE', 2);
define('CANCEL_INVITE_EMAIL_TYPE', 3);
define('CANCEL_EVENT_EMAIL_TYPE', 4);

App::uses('Component', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Componente para el envío de correos como sistema de notificaciones
 */
class BinluuEmailComponent extends Component {
    
	/**
	 * Sistema de notificaciones para eventos y confirmación de correos, 
	 * por medio de mails.
	 * @param  [int] 	$user_from_id [id del usuario que envía el email]
	 * @param  [string] $user_to      [usuario destinatario]
	 * @param  [int] 	$email_type   [tipo de email a enviar]
	 * @param  [int] 	$event_id     [id del evento involucrado (opcional)]
	 * @return [bool]                 [Estatus de envío de correo]
	 */
    public function sendMail($user_from_id, $user_to, $email_type, $event_id = null) {
    	$message = "";
    	$subject = "";
    	$user = ClassRegistry::init('User');
    	$event = ClassRegistry::init('Event');
    	$user_db = $user->findById($user_from_id);
    	if ($event_id != null && $email_type != CONFIRM_EMAIL_TYPE)
    		$event_db = $event->findById($event_id);
    	switch ($email_type) {
    		case CONFIRM_EMAIL_TYPE:
    		    $subject = 'Confirmación de correo';
                    $link = "http://".$_SERVER['HTTP_HOST']."/User/confirm/".urlencode($this->getSecretId($user_from_id));
                    $message = "Hola " . utf8_encode($user_db['User']['name']) ."<br /><p>Para completar tu registro necesitamos que confirmes dando clic <a href='$link' >aquí</a>, Gracias por registrarte en www.binluu.com.mx</p>";
                    break;
    		case INVITE_EMAIL_TYPE:
    			$subject = 'Te han invitado a un evento';
    			$link = "http://".$_SERVER['HTTP_HOST']."/Event/view/".urlencode($this->getSecretId($event_id));
                        $message = $user_db['User']['name']." te ha invitado al evento:". $event_db['Event']['name'] ."el día:". $event_db['Event']['date']. ", para saber más da clic <a href='$link' >aquí</a> o inicia sesión desde www.binluu.com.mx";
    			break;
    		case ACCEPT_INVITE_EMAIL_TYPE:
    			$subject = 'Han aceptado una invitación';
    			$link = "http://".$_SERVER['HTTP_HOST']."/index.php/Event/view/".urlencode($this->getSecretId($event_id));
                        $message = $user_db['User']['name'].' '.$user_db['User']['last_name']." ha confirmado su asistencia al evento: ".$event_db['Event']['name'].", revisa quien mas ha confirmado <a href='$link' >aquí</a> o inicia sesión desde www.binluu.com.mx";          			
    			break;
    		case CANCEL_INVITE_EMAIL_TYPE:
    		    $subject = 'Han cancelado una invitación';
    		    $link = "http://".$_SERVER['HTTP_HOST']."/index.php/Event/view/".urlencode($this->getSecretId($event_id));
                    $message = $user_db['User']['name'].' '.$user_db['User']['last_name']." ha cancelado su asistencia al evento: ".$event_db['Event']['name'].", revisa quien mas ha confirmado o cancelado <a href='$link' >aquí</a> o inicia sesión desde www.binluu.com.mx";   			
    			break;
    		case CANCEL_EVENT_EMAIL_TYPE:
    		    $subject = 'Han cancelado un evento'; 
                    $message = $user_db['User']['name']." ha cancelado el evento: ".$event_db['Event']['name']." al que fuiste invitado, para ver los eventos a los que has sido invitado inicia sesión desde www.binluu.com.mx";
    			break;    		
    	}
        try {
            $email = new CakeEmail('binluumail');
            $email->from(array(Configure::read('email.info')=>"Información Binluu"));
            $email->to($user_to);
            $email->subject($subject);
            $email->emailFormat("html");
            if($email->send($message)){
                //SALVAR DATOS DE EMAIL
                $mail = ClassRegistry::init('Mail');
                $mail->create();
                $mail->set('user_id', $user_from_id);
                $mail->set('from', $user_db['User']['username']);
                $mail->set('to', $user_to);
                $mail->set('subject', $subject);
                $mail->set('content', $message);
                $mail->set('sended', 1);
                $mail->set('','html');
                $mail->save();
                return true;
            }
            else{
                
                return false;
            } 
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Obtiene el hash de un id
     * @param  [int] $id [id a cifrar]
     * @return [string]     [id cifrado]
     */
    public function getSecretId($id){
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $encrypted = Security::rijndael(intval($id), $key, 'encrypt');
        return strtr(base64_encode($encrypted), '+/=', '-_,');
    }

    public function getIdFromSecretId($secret_id){
        $secret_id = urldecode($secret_id);
        $secret_id = base64_decode(strtr($secret_id, '-_,', '+/='));
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $decrypted = Security::rijndael($secret_id, $key, 'decrypt');
        return $decrypted;
    }

    /**
     * Función que genera un link de confiramción para promotores de eventos
     * @param  [int]    $user_id        [id del promotor]
     * @param  [string] $username       [Nombre del promotor]
     * @param  [string] $user_password  [Password del promotor]
     * @return [bool]                   [Estatus de envío del correo]
     */
    public function sendAdviserConfirmMail($user_id, $adviser_email, $adviser_name){
        $subject = 'Confirmación de correo';
        $link = "http://".$_SERVER['HTTP_HOST']."/index.php/Adviser/confirm/".urlencode($this->getSecretUserId($user_id));
        $message = 'Hola, '.$adviser_name.', para confirmar tu correo da clic en la siguiente dirección: '.$link;        
        $email = new CakeEmail('binluumail');
        $email->from(array(Configure::read('email.info')=>""));
        $email->to($adviser_email);
        $email->subject($subject);
        return $email->send($message);
    }

    /**
     * Función que envía un email al correo de contacto para ofrecer información
     * a inmobiliarias
     * @param  [string] $name    [Nombre de la inmobiliaria]
     * @param  [string] $email   [Email a contactar]
     * @param  [string] $message [Petición de información]
     * @return [bool]            [Estatus de envío de correo]
     */
    public function sendConfirmMail($name, $email,$phone, $message){
        $subject = "Han pedido información acerca del servicio";
        $message ="<p>".$name." Ha solicitado información, ".
                    ", Correo electronico: ".$email.
                    ", Teléfono de contacto: ".$phone.
                    ", Mensaje: \n".$message;
        $email = new CakeEmail('binluumail');
        $email->from(Configure::read('email.info'));
        $email->to(Configure::read('email.contact'));
        $email->subject($subject);
        return $email->send($message);
    }

}

?>