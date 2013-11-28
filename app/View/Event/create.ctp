<?php echo $this->Html->css('binluu.components'); ?>
<?php echo $this->Html->css('adviser.events'); ?>
<div class="event_creation">
	<p class="desc_title">Intoduzca los datos y escoja una ubicaci&oacute;n</p>
	<?php echo $this->Form->create('Event'); ?>
	<div class="left">
		<?php echo $this->Form->input('Event.name', array('label'=>false, 'placeholder'=>'Nombre del evento', 'style'=>'width:300px; display:block;')); ?>
		<?php echo $this->Form->input('Event.address', array('label'=>false, 'placeholder'=>'Dirección', 'style'=>'width:300px; display:block;')); ?>
		<?php echo $this->Form->input('Event.date', array('label'=>false, 'placeholder'=>'Fecha', 'style'=>'width:100px')); ?>
	</div>
	<div class="right">
		<?php echo $this->Form->textarea('Event.property_description', array('label'=>false,'rows'=>'9', 'placeholder'=>'Descripción del inmueble', 'style'=>'width:300px; height: 150px;')); ?>
	</div>
	<div class="details">
		<div id="map">
		</div>
		<div class="images">
			<p>Suba dos fotos del lugar</p>	
			<div class="img_box"></div>
			<div class="img_box"></div>		
		</div>
	</div>
	<div class="action">
			<?php echo $this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'cancel')); ?>
			<?php echo $this->Form->end("Siguiente >"); ?>
	</div>
</div>
	<?php
			/*echo "<h3>Datos del evento</h3>";
			echo "<label>Nombre de evento:</label>";
			echo $this->Form->input('Event.name', array('label'=>false));
			echo "<label>Día del evento:</label>";
			echo $this->Form->input('Event.date', array('label'=>false, 'type'=>'date'
				,'dateFormat'=>'DMY'));
			echo "<label>Desripción</label>";
			echo "<br>";
			echo $this->Form->textarea('Event.property_description', array('label'=>false,"rows"=>"9"));
			echo "<h3>Propiedad</h3>".$this->Html->link('NUEVA', array('controller'=>'AdviserProperty', 'action'=>'add'));
			echo $this->Form->input('Event.property_id',array('label'=>'','options'=>$properties, 'empty'=>'(Selecciona una propiedad)'));
			echo "<h3>Perfil del evento</h3>";
			echo "<label>Edad:</label>";
			echo $this->Form->input('EventProfile.age', array('label'=>false));
			echo "<label>Sexo:</label>";
			echo $this->Form->input('EventProfile.sex', array('label'=>false, 'options'=>$sex, 'empty'=>'(Seleccione el sexo)'));
			echo "<label>Presupuesto</label>";
			echo $this->Form->input('EventProfile.budget', array('label'=>false));*/
		?>		
	<?php //echo $this->Form->end("CREAR EVENTO"); ?>