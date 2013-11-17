<div>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
	<br>
	<?php echo $this->Html->link('REGRESAR', array('controller'=>'Event','action'=>'index'));?>
	|
	<?php echo $this->Html->link('CONFIRMAR ASISTENCIA', array('action'=>'confirm',$request['Request']['id']));?>
	|
	<?php echo $this->Html->link('CANCELAR ASISTENCIA', array('action'=>'cancel',$request['Request']['id'])); ?>
</div>