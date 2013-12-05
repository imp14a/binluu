<?php 

    echo $this->Html->css('binluu.components');
    echo $this->Html->css('binluu.default');
    echo $this->Html->css('binluu.register');
    echo $this->Html->script('binluu.components');
  
?>
<style>
    .background{
        background: white !important; /* Old browsers */
    }
    .backButton{
        margin-top: 15px;
        text-decoration: none;
        height: 24px;
        display: block;
        background: #fcee3a; /* Old browsers */
        background: -moz-linear-gradient(top, #fcee3a 0%, #fef8b0 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fcee3a), color-stop(100%,#fef8b0)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* IE10+ */
        background: linear-gradient(to bottom, #fcee3a 0%,#fef8b0 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcee3a', endColorstr='#fef8b0',GradientType=0 ); /* IE6-9 */
        color: #444;
        padding: 5px;
        line-height: 28px;
        padding-left: 15px;
        padding-right: 15px;
        border:none;
    }
    .backButton.submit{
        margin-right: 50px;
        float: right;
        height: 52px;
        width: 110px;
        margin-top: 30px;
        font-weight: bold;
    }
    .information input{
        border: 1px solid #999 !important;
        height: 32px !important;
    }
    .information{
        float: none;
        width: 50%;
    }
</style>
<div style="text-align: center;">
    <?php echo $this->Html->link("< Regresar",array('controller'=>"User",'action'=>"login"),array('class'=>'backButton'));?>
    <div id="stepProces" class="stepProces">
        <?php echo $this->Form->create("Register"); ?>
        <div class="step" style="border:none;">
            <div class="information container" style="box-shadow: 10px 10px 20px 20px #CCC;">
                <div class="background"></div>
                <span class="title" style="color:#444;">Registro de Asesor</span>
                <?php echo $this->Form->input("User.name",array('label'=>false,'placeholder'=>"Nombre")); ?>
                    <?php echo $this->Form->input("User.last_name",array('label'=>false,'placeholder'=>"Apellidos")); ?>
                    <?php echo $this->Form->input("Adviser.company",array('label'=>false,'placeholder'=>"Empresa/Inmobiliaria")); ?>
                    <?php echo $this->Form->input("Adviser.web",array('label'=>false,'placeholder'=>"Sitio Web")); ?>
                    <?php echo $this->Form->input("Adviser.phone",array('label'=>false,'placeholder'=>"Teléfono")); ?>
                <span class="title" style="color:#444; font-size: 12px;">Cuenta de Acceso</span>
                <?php echo $this->Form->input("User.username",array("type"=>"email",'label'=>false,"placeholder"=>"Correo electrónico")); ?>
                <?php echo $this->Form->password("User.password",array('placeholder'=>"Contraseña"))?>
                <?php echo $this->Form->password("User.password_confirm",array('placeholder'=>"Repite tu contraseña")); ?>
                <button type="submit" class="backButton submit" >Registrar</button>
         </div>
        </div>
         <?php echo $this->Form->end(); ?>
    </div>
</div>