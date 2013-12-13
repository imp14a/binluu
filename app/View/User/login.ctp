<?php   echo $this->Html->css('binluu.login'); 
        echo $this->Html->css('lightwindow');
        echo $this->Html->script('lightwindow');
?>
<?php if($this->Session->read('FirstTime')): ?>
    <div class="firsttime" style="display: none;"></div>
<?php endif;?>
<div class="loginContent">
        <?php echo $this->Session->flash('auth'); ?>
        <?php if(isset($after_register)):?>
            <div  class="loginimage" style="background-image: url('/img/after_register.png'); background-size: contain; background-position: center; background-repeat: no-repeat;" ></div>
        <?php elseif(isset($mail_confirmed)): ?>
            <div  class="loginimage" style="background-image: url('/img/mail_confirmed.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;" >
                <div style="background-image: url('/img/confirmed_message.png'); background-size: contain; background-position: top left; background-repeat: no-repeat;width: 100%; height: 100%; background-size: 40%; margin-top: 20px; margin-left: 20px;"></div>
            </div>
        <?php else: ?>
            <div  class="loginimage"></div>
        <?php endif;?>
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
</div>
<div class="aboutContent">
    <?php echo $this->Html->link($this->Html->div('about','¿Cómo funciona?') ,
            array('controller' => 'Binluu', 'action' => 'about'),
            array('escape'=>false,'id'=>'aboutBinluu',"class"=>"lightwindow",'params'=>'lightwindow_width=853,lightwindow_height=480,lightwindow_type=page')); ?>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-46238782-1', 'binluu.com.mx');
ga('send', 'pageview');

console.log()
if($$('.firsttime').size()==1)
{   
    Event.observe(window, 'load', function(){
        $('aboutBinluu').click();
    });
}
</script>
