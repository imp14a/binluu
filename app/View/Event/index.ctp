<?php $isPerson = $this->Session->read('Auth.User.rol') === 'Person';?>
<?php if($isPerson) echo $this->element('person_events', array('events' => $events)); ?>