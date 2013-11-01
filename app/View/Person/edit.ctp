


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
// Enable the visual refresh
google.maps.visualRefresh = true;

var geocoder;
var map;
var markersArray = [];

function initialize() {
	geocoder = new google.maps.Geocoder();

	var mapZoom = 5;
	if($("IdealPropertyLatitude").getValue()!=""){
    	mapCenter = new google.maps.LatLng(
    		Number($("IdealPropertyLatitude").getValue()),
    		Number($("IdealPropertyLongitude").getValue())
    	);
    	mapZoom = 8; 
    }else{
    	mapCenter = new google.maps.LatLng(22.913,-101.929);
    }

	var mapOptions = {
        zoom: mapZoom,
        center: mapCenter,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    if($("IdealPropertyLatitude").getValue()!=""){
    	placeMarker(mapCenter);
    }

    google.maps.event.addListener(map, 'dblclick', function(event) {
    	placeMarker(event.latLng);
	});
}

google.maps.event.addDomListener(window, 'load', initialize);

function deleteOverlays() {
	if (markersArray.length >= 1) {
		markersArray[0].setMap(null);
		markersArray.length = 0;
  	}
}

function placeMarker(location) {
	$('IdealPropertyLatitude').setValue(location.lat());
	$('IdealPropertyLongitude').setValue(location.lng());
	deleteOverlays();
	var marker = new google.maps.Marker({
	    position: location,
	    map: map
	});
	markersArray.push(marker);
	markersArray[0].setMap(map);
	
}

</script>
<div>
	<?php echo $this->Form->create("Edit"); ?>
		<h3>Registrate</h3>
		<div class="profileinfo">
			<?php echo $this->Form->input("User.name",array("value"=>$person['User']['name'])); ?>
			<?php echo $this->Form->input("User.last_name",array("value"=>$person['User']['last_name'])); ?>
			<?php echo $this->Form->input("PersonProfile.age",array("value"=>$person['PersonProfile']['age'])); ?>
			<?php $options = array('M' => 'Masculino', 'F' => 'Femenino');  
				echo $this->Form->radio("PersonProfile.sex",$options,array('value'=>$person['PersonProfile']['sex'])); 
				?>
			<?php echo $this->Form->input("PersonProfile.ocupation",array('value'=>$person['PersonProfile']['ocupation'])); ?>
			<?php echo $this->Form->textarea('PersonProfile.interests', array('label'=>false,"rows"=>"9",'value'=>$person['PersonProfile']['interests'])); ?>
		</div>
		<div class="propertyinfo">
			<p>Indica en el mapa donde deseas vivir se creara un radio de 1.5km a partir del punto que escogas</p>
			<?php echo $this->Form->hidden("IdealProperty.latitude",array("value"=>$person['IdealProperty']['latitude'])); ?>
			<?php echo $this->Form->hidden("IdealProperty.longitude",array("value"=>$person['IdealProperty']['longitude'])); ?>
			<div id="map-canvas" style="width:400px; height:400px;"></div>
		</div>
	<?php echo $this->Form->end("Actualizar")?>
	<?php echo $this->Form->create(null,array('url' => array('controller'=>'User','action'=>'password'))); ?>
		<div class="userinfo">
			<?php echo $this->Form->input("User.username",array("type"=>"email",'disabled'=>'disabled','value'=>$person['User']['username'])); ?>
			<?php echo $this->Form->password("User.password"); ?>
			<?php echo $this->Form->password("User.password_confirm"); ?>
		</div>
	<?php echo $this->Form->end("Actualizar")?>

	
	<?php echo $this->Html->link('Desactivar Cuenta',array('controller'=>'User','action'=>'delete'));?>
</div>