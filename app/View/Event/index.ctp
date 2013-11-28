<?php $isPerson = $this->Session->read('Auth.User.rol') === 'Person';?>
<?php if($isPerson){ 
		echo $this->element('person_events', array('events' => $events));
	}else{
		echo $this->element('adviser_events', array('events' => $events));
	} ?>
