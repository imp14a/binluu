<div>
	<?php echo $this->Form->create("Register"); ?>
		<h3>Registrate</h3>
		<div class="profileinfo">
			<?php echo $this->Form->input("User.name"); ?>
			<?php echo $this->Form->input("User.last_name"); ?>
		</div>
		<div class="userinfo">
			<?php echo $this->Form->input("User.username",array("type"=>"email")); ?>
			<?php echo $this->Form->password("User.password"); ?>
			<?php echo $this->Form->password("User.password_confirm"); ?>
		</div>
	<?php echo $this->Form->end("Registrar Administrador")?>
</div>