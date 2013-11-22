<?php echo $this->Html->css('person.events'); ?>
<div class="events_container">
	<p class="title">Eventos a los que has sido invitado :)</p>
	<?php foreach ($events as $event): ?>
	<div class="event_item">
		<div class="images">
			<?php echo $this->Html->image('cake_logo.png', array('alt' => 'CakePHP')); ?>
			<?php //foreach ($event['PropertyImages'] as $image): ?>
			<?php //endforeach; ?>
	  </div>
	  <div class="description">
	  	<div class="event_title">
	  		<label>Visita a departamento en <?php //echo $event['Event']['address']; ?></label>
	  	</div>
	  	<div class="detail">
	  		<label>Descripci&oacute;n:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
	  		<label>Direcci&oacute;n:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
	  		<label>Fecha:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['date']); ?>
	  		<label>Hora:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
	  		<label>Invita:</label>
	  		<?php //var_dump($event['Event']); ?>
	  		<?php echo $this->Html->para(null, $event['Event']['Adviser']['User']['name'].' '.$event['Event']['Adviser']['User']['last_name']); ?>
	  	</div>
			<div class="invited_users">
				<label>Tambi&eacute;n fueron invitados:</label>
			</div>
	  </div>
	  <div class="request">
	  	<label class="block legend">Asistir:</label>
	  	<?php echo $this->Html->link('Sí', array('controller'=>'Request', 'action'=>'confirm', $event['Request']['id']), array('class'=>'block response')); ?>
	  	<?php echo $this->Html->link('No', array('controller'=>'Request', 'action'=>'cancel', $event['Request']['id']), array('class'=>'block response')); ?>
	  </div>
	</div>
	<div class="cintillo">
			<?php echo $this->Html->image('cake_logo.png', array('alt' => 'CakePHP')); ?>
	</div>
	<?php endforeach; ?>
<!--	<div class="event_item">
		<div class="images">
			<?php echo $this->Html->image('cake_logo.png', array('alt' => 'CakePHP')); ?>
			<?php //foreach ($event['PropertyImages'] as $image): ?>
			<?php //endforeach; ?>
	  </div>
	  <div class="description">
	  	<div class="event_title">
	  		<label>Visita a departamento en <?php //echo $event['Event']['address']; ?></label>
	  	</div>
	  	<div class="detail">
	  		<label>Descripci&oacute;n:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
	  		<label>Direcci&oacute;n:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
	  		<label>Fecha:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['date']); ?>
	  		<label>Hora:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
	  		<label>Invita:</label>
	  		<?php //var_dump($event['Event']); ?>
	  		<?php echo $this->Html->para(null, $event['Event']['Adviser']['User']['name'].' '.$event['Event']['Adviser']['User']['last_name']); ?>
	  	</div>
			<div class="invited_users">
				<label>Tambi&eacute;n fueron invitados:</label>
			</div>
	  </div>
	  <div class="request">
	  	<label class="block legend">Asistir:</label>
	  	<?php echo $this->Html->link('Sí', array('controller'=>'Request', 'action'=>'confirm', $event['Request']['id']), array('class'=>'block response')); ?>
	  	<?php echo $this->Html->link('No', array('controller'=>'Request', 'action'=>'cancel', $event['Request']['id']), array('class'=>'block response')); ?>
	  </div>
	</div>
	<div class="cintillo">
			<?php echo $this->Html->image('cake_logo.png', array('alt' => 'CakePHP')); ?>
	</div>
-->
</div>
