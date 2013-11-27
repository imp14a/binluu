<?php echo $this->Html->css('person.events'); ?>
<div class="person_profile">
	<h3>Perfil de usuario</h3>
	<div class="image">
	<?php $image = $person['User']['image']===null?$person['PersonProfile']['sex']==='M'?'default_img_male.png':'default_img_female.png':$person['User']['image']; ?>
	<?php echo $this->Html->image('/files/'.$image, array('alt'=>'Imagen de perfil')); ?>
	</div>
	<div class="profile">
		<label>Nombre:</label>
		<?php echo $this->Html->para(null, $person['User']['name'].' '.$person['User']['last_name']); ?>
		<label>Edad:</label>
		<?php echo $this->Html->para(null, $person['PersonProfile']['age']); ?>
		<label>Sexo:</label>
		<?php echo $this->Html->para(null, $person['PersonProfile']['sex']); ?>
		<label>Ocupaci&oacute;n:</label>
		<?php echo $this->Html->para(null, $person['PersonProfile']['ocupation']); ?>
		<label>Intereses:</label>
		<?php foreach ($person['PersonProfile']['PersonProfileTag'] as $tag): ?>
		<?php echo $this->Html->para(null, $tag['tag']); ?>
		<?php endforeach; ?>
	</div>
</div>