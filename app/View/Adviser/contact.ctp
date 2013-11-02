

<div  >
	<?php echo $this->Form->create('Contact'); ?>
		<br>
		<?php
			echo "<label>Nombre de la inmobiliaria</label>";
			echo $this->Form->input('name', array('label'=>false));
			echo "<label>Correo Electrónico</label>";
			echo $this->Form->input('email', array('label'=>false));
			echo "<label>Mensaje</label>";
			echo $this->Form->textarea('message', array('label'=>false,"rows"=>"9"));
		?>
	<?php echo $this->Form->end("ENVIAR"); ?>
</div>