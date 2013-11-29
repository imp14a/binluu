
<?php 

echo $this->Html->css('binluu.login');
echo $this->Html->css('binluu.components'); 
echo $this->Html->css('binluu.adviser.contact.css'); 

?>
<div class="concatContent">
	<div class="mainImage" ></div>
	<div class="information">
            <div class="background"></div>
            <div class="detail"></div>
		<span class="title">Quiero recibir informaci&oacute;n</span>
		<?php echo $this->Form->create('Contact'); ?>
			<?php
				echo $this->Form->input('name', array('label'=>false,'placeholder'=>'Nombre de la inmobiliaria',"style"=>"height:28px;"));
				echo $this->Form->input('email', array('label'=>false,'placeholder'=>'Correo electrónico'));
				echo $this->Form->input('phone', array('label'=>false,'placeholder'=>'Teléfono'));
				echo $this->Form->textarea('message', array('label'=>false,'placeholder'=>'Mensaje'));
			?>
		<?php echo $this->Form->end("ENVIAR"); ?>
	</div>
</div>