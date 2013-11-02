<?php echo $this->Form->create(null,array('url' => array('controller'=>'User','action'=>'password',"Admin"))); ?>
<div class="userinfo">
	<?php echo $this->Form->input("User.username",array("type"=>"email",'disabled'=>'disabled',
	'value'=>$admin['User']['username'])); ?>
	<?php echo $this->Form->password("User.password"); ?>
	<?php echo $this->Form->password("User.password_confirm"); ?>
</div>
<?php echo $this->Form->end("Actualizar")?>