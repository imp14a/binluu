<div>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
	<br>
	<?php echo $this->Html->link('REGRESAR', array('action'=>'index'));?>
	<p><b>Nombre del evento</b></p>
	<?php echo $this->Html->tag('Name', $event['Event']['name']);?>
	<p><b>Descripci&oacute;n</b></p>
	<?php echo $this->Html->tag('Description', $event['Event']['property_description']);?>
	<p><b>D&iacute;a del evento</b></p>
	<?php echo $this->Html->tag('Date', $event['Event']['date']);?>
</div>