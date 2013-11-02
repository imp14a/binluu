<div class="loginContent">
	<div class="loginContainer">
		<?php echo $this->Session->flash('auth'); ?>
		<h3>INICIAR SESI&Oacute;N</h3>
		<?php echo $this->Form->create('User');?>
	        <label>Correo electrónico</label>
	        <div class="input email">
	        	<?php echo $this->Form->input('username',array('type'=>'email','label'=>false)); ?>
	        </div>
	        <label>Contraseña (mínimo 6 cacteres)</label>
	        <div class="input password">
	        	<?php echo $this->Form->input('password', array('label'=>false)); ?>
	        </div>
	        <div class="submit" style="margin-left: 10px;">
	            <input type="submit" class="activeButton" value="ENTRAR">
	        </div>
	    <?php echo $this->Form->end();?>
	    <?php echo $this->Html->link('Registrate',array('controller'=>'Person','action'=>'register'));?>
	    <?php echo $this->Html->link('Soy asesor inmobiliario',array('controller'=>'Adviser','action'=>'contact'));?>
	    
	</div>
</div>