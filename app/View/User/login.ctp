<?php echo $this->Html->css('binluu.login'); ?>
<div class="loginContent">
    <?php echo $this->Session->flash('auth'); ?>
    <?php if(isset($after_register)):?>
        <div  class="loginimage" style="background-image: url('/img/after_register.png'); background-size: contain; background-position: center; background-repeat: no-repeat;" ></div>
    <?php elseif(isset($mail_confirmed)): ?>
        
    <?php else: ?>
        <div  class="loginimage" ></div>
    <?php endif;?>
        </>
    <div class="loginContainer">
        <div class="background"></div>
        <div class="detail"></div>
        
        <span class="logintitle">Inicia Sesi&oacute;n</span>
        <div class="play"></div>
        <?php echo $this->Form->create('User');?>
        <div class="input email">
            <?php echo $this->Form->input('username',array('type'=>'email','label'=>false,'placeholder'=>"correo electrónico","div"=>false)); ?>
        </div>
        <div class="input password" style="margin-top:15px;">
                <?php echo $this->Form->input('password', array('label'=>false,"div"=>false,'placeholder'=>"contraseña")); ?>
        </div>
        <?php echo $this->Form->end('Ok!');?>
        <div class="clear"></div>
        <div class="footerlogin">
            <span class="notregister">&iquest;A&uacute;n no tienes cuenta&quest;</span>
            <?php echo $this->Html->link('¡Registrate!',array('controller'=>'Person','action'=>'register'),array('class'=>'registerButton'));?>
        </div>
        
    </div>
    <div class="aboutContent">
        <?php echo $this->Html->link($this->Html->div('about','¿Cómo funciona?') ,array('controller' => 'User', 'action' => 'about'), array('escape'=>false)); ?>
    </div>
</div>