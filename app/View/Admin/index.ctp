<?php echo $this->Html->link('Salir',array('controller'=>'User','action'=>'logout'));?>
|
<?php echo $this->Html->link('Agregar Promotor',array('controller'=>'Adviser','action'=>'register'));?>
|
<?php echo $this->Html->link('Asignar creditos',array('controller'=>'Account','action'=>'assign'));?>
|
<?php echo $this->Html->link('Editar perfil',array('controller'=>'Admin','action'=>'edit'));?>
|
<?php echo $this->Html->link('Listar promotores',array('controller'=>'Adviser','action'=>'listAll'));?>
|
<?php echo $this->Html->link('Listar usuarios',array('controller'=>'Person','action'=>'listAll'));?>