<div>
	<?php echo $this->Form->create('Request');?>
	<h4>Invitar Usuarios</h4>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>  
	<br>
  <?php foreach ($persons as $person) {
    echo $this->Form->input('person_id', array(
      'type' => 'checkbox',
      'label' => $person['User']['name'],
      'name' => 'data[Request][person_id][]',
      'id' => 'RequestPersonId'.$person['Person']['id'],
      'value' => $person['Person']['id'],
      'after' => '<div class="tags">'/*.
                  foreach ($person['PersonProfile']['interest'] as $tag) {
                    '<label class="tag">'.$tag['name'].'</label>';
                  }*/
                  .'</div>'
      ));
  }?>
	<?php echo '';/*$this->Form->input('person_id', array(
    'label' => false,
    'type' => 'select',
    'multiple' => 'checkbox',
    'options' => $options,
    'after' => '<div class="tags"><label>Miuchi</label><label>Otro</label></div>'
  ));*/?>
  <?php echo $this->Form->end('ENVIAR INVITACIÓN');?>

</div>