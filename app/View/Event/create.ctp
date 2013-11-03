

<div>
	<?php echo $this->Form->create('Event'); ?>
		<br>
		<?php
			echo "<label>Nombre de evento:</label>";
			echo $this->Form->input('name', array('label'=>false));
			echo "<label>Día del evento:</label>";
			echo $this->Form->input('date', array('label'=>false, 'dateFormat' => 'DMY'));
			echo "<label>Desripción</label>";
			echo $this->Form->textarea('property_description', array('label'=>false,"rows"=>"9"));
		?>
	<?php echo $this->Form->end("CREAR EVENTO"); ?>
</div>