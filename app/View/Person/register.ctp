

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
	<?php echo $this->Form->create("Register"); ?>
		<h3>Registrate</h3>
		<div class="profileinfo">
			<?php echo $this->Form->input("User.name"); ?>
			<?php echo $this->Form->input("User.last_name"); ?>
			<?php echo $this->Form->input("PersonProfile.age"); ?>
			<?php $options = array('M' => 'Masculino', 'F' => 'Femenino'); 
				echo $this->Form->radio("PersonProfile.sex",$options); 
				?>
			<?php echo $this->Form->input("PersonProfile.ocupation"); ?>
			<?php echo $this->Form->textarea('PersonProfile.interests', array('label'=>false,"rows"=>"9")); ?>
		</div>
		<div class="userinfo">
			<?php echo $this->Form->input("User.username",array("type"=>"email")); ?>
			<?php echo $this->Form->password("User.password"); ?>
			<?php echo $this->Form->password("User.password_confirm"); ?>
		</div>

		<div class="propertyinfo">
			<p>Indica en el mapa donde deseas vivir se creara un radio de 1.5km a partir del punto que escogas</p>
			<?php echo $this->Form->hidden("IdealProperty.latitude"); ?>
			<?php echo $this->Form->hidden("IdealProperty.longitude"); ?>
			<div id="map-canvas" style="width:400px; height:400px;"></div>
		</div>
	<?php echo $this->Form->end("Registrate")?>
</div>