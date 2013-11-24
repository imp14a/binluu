
<?php 

	if($contact_info_send){
		echo $this->element('contact_info_send');
	}else{
		echo $this->element('contact_info');
	}

?>
