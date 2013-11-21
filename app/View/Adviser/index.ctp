<?php echo $this->Html->link('Salir',array('controller'=>'User','action'=>'logout')); ?>
|
<?php echo $this->Html->link('Editar perfil',array('controller'=>'Adviser','action'=>'edit')); ?>
|
<?php echo $this->Html->link('Listar propiedades',array('controller'=>'AdviserProperty','action'=>'index')); ?>
|
<?php echo $this->Html->link('Listar eventos',array('controller'=>'Event','action'=>'index')); ?>
|
<?php echo $this->Html->link('Crear evento',array('controller'=>'Event','action'=>'create')); ?>