<div>
		<h3>Actualiza tu informaci&oacute;n</h3>
		<div class="profileinfo">
			<?php echo $this->Form->create(null,array('url' => array('controller'=>'User','action'=>'image','Adviser', $adviser['User']['id']), 'type'=>'file')); ?>
			<?php 
				$sex = 'M';
				$image = $adviser['User']['image']===NULL?$sex==='M'?'default_img_male.png':'default_img_female.png':$adviser['User']['image'];
				$image = DS.'files'.DS.$image;
				echo $this->Html->image($image); ?>
			<?php echo $this->Form->input('User.image', array('label'=>'Imagen de perfil', 'type'=>'file')) ;?>
			<?php echo $this->Form->end('Actualizar imagen'); ?>

			<?php echo $this->Form->create("Edit"); ?>
			<?php echo $this->Form->input("User.name",array('value'=>$adviser['User']['name'])); ?>
			<?php echo $this->Form->input("User.last_name",array('value'=>$adviser['User']['last_name'])); ?>
			<?php echo $this->Form->input("Adviser.company",array('value'=>$adviser['Adviser']['company'])); ?>
			<?php echo $this->Form->input("Adviser.web",array('value'=>$adviser['Adviser']['web'])); ?>
			<?php echo $this->Form->input("User.phone",array('value'=>$adviser['User']['phone'])); ?>
		</div>
	<?php echo $this->Form->end("Actualizar")?>

	<?php echo $this->Form->create(null,array('url' => array('controller'=>'User','action'=>'password',"Adviser"))); ?>
		<div class="userinfo">
			<?php echo $this->Form->input("User.username",array("type"=>"email",'disabled'=>'disabled','value'=>$adviser['User']['username'])); ?>
			<?php echo $this->Form->password("User.password"); ?>
			<?php echo $this->Form->password("User.password_confirm"); ?>
		</div>
	<?php echo $this->Form->end("Actualizar")?>
	<?php echo $this->Html->link('Desactivar Cuenta',array('controller'=>'User','action'=>'delete'));?>
</div>