<?php echo $this->Html->link('Salir',array('controller'=>'User','action'=>'logout')); ?>
|
<?php if($this->Session->read('Auth.User.rol')=="Person"):?>
	<?php echo $this->Html->link('Editar perfil',array('controller'=>'Person','action'=>'edit')); ?>
|
<?php elseif($this->Session->read('rol')=="Adviser"): ?>
<?php endif;?>
<?php echo $this->Html->link('Listar eventos',array('controller'=>'Event','action'=>'index')); ?>
