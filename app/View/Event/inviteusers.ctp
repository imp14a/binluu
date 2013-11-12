<div>
	<?php echo $this->Form->create('Request');?>
	<h4>Invitar Usuarios</h4>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>  
	<br>
	<?php echo $this->Form->input('person_id', array(
    'label' => false,
    'type' => 'select',
    'multiple' => 'checkbox',
    'options' => $options
  ));?>
  <?php echo $this->Form->end('ENVIAR INVITACIÓN');?>

</div>