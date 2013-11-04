<div>
	<?php echo $this->Form->create("Account"); ?>
		<h3>Asigna creditos</h3>
		<div class="profileinfo">
			<?php echo $this->Form->input("username"); ?>
			<?php echo $this->Form->input("quantity",array('type'=>'number')); ?>
		</div>
	<?php echo $this->Form->end("Asignar")?>
</div>