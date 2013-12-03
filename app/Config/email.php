<?php

//Configure::write('email.info', 'info@zumoinmobiliaria.com.mx');
Configure::write('email.info', 'notify@binluu.com.mx');
Configure::write('email.admin', 'omar.pc@binluu.com.mx');
//Configure::write('email.contact', 'contacto@zumoinmobiliaria.com.mx');
Configure::write('email.contact', 'contact@binluu.com.mx');

class EmailConfig {


    /*public $binluumail = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'rgarcia.cejudo@gmail.com',
        'password' => ',.R1c4rd0GC.,',
        'transport' => 'Smtp'
    );*/
    
    public $binluumail = array(
        'host' => 'mail.binluu.com.mx',
        'port' => 25,
        'username' => 'notify',
        'password' => '9C1h9emV',
        'transport' => 'Smtp',
        'tls' => true
    );
}
?>