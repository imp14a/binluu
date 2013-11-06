

<div>
	<?php echo $this->Form->create('Event'); ?>
		<br>
		<?php
			echo "<label>Nombre de evento:</label>";
			echo $this->Form->input('Event.name', array('label'=>false));
			echo "<label>Día del evento:</label>";
			echo "<input type=\"date\" name=\"bday\">";
			//echo $this->Form->input('Event.date', array('label'=>false, 'type'=>'date'));
			echo "<label>Desripción</label>";
			echo $this->Form->textarea('Event.property_description', array('label'=>false,"rows"=>"9"));
			echo "<h3>Perfil del evento</h3>";
			echo "<label>Edad:</label>";
			echo $this->Form->input('EventProfile.age', array('label'=>false));
			echo "<label>Sexo:</label>";
			echo $this->Form->input('EventProfile.sex', array('label'=>false));
			echo "<label>Ocupación:</label>";
			echo $this->Form->input('EventProfile.ocupation', array('label'=>false));
			echo "<label>Intereses</label>";
			echo $this->Form->textarea('EventProfile.interests', array('label'=>false,"rows"=>"9"));
		?>		
	<?php echo $this->Form->end("CREAR EVENTO"); ?>
</div>