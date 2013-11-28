<div>
	<?php echo $this->Form->create('Request');?>
	<h4>Invitar Usuarios</h4>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>  
	<br>
  <?php foreach ($persons as $person) {
    echo $this->Form->input('person_id', array(
      'type' => 'checkbox',
      'hiddenField' => false,
      'label' => $person['User']['name'],
      'name' => 'data[Request][person_id][]',
      'id' => 'RequestPersonId'.$person['Person']['id'],
      'value' => $person['Person']['id']
      ));
    echo '<div class="tags">';
    foreach ($person['PersonProfile']['PersonProfileTag'] as $tag)
    {
      echo '<label class="tag">'.$tag['tag'].'</label>';
    }
    echo '</div>';
  }?>
  <?php echo $this->Form->end('ENVIAR INVITACIÓN');?>

</div>