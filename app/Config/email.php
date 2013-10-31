<?php

//Configure::write('email.info', 'info@zumoinmobiliaria.com.mx');
Configure::write('email.info', 'rgarcia.cejudo@gmail.com');
Configure::write('email.admin', 'admin@zumoinmobiliaria.com.mx');
Configure::write('email.contact', 'contacto@zumoinmobiliaria.com.mx');

class EmailConfig {


    public $binluumail = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'rgarcia.cejudo@gmail.com',
        'password' => ',.R1c4rd0GC.,',
        'transport' => 'Smtp'
    );
}
?>