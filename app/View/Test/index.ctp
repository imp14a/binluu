<?php 
	echo $this->Form->create('User', array('type' => 'file'));
	echo $this->Form->input('image_file', array('label'=>'Imagen:', 'type'=>'file')); 
	echo $this->Form->end('PROBAR');
?>