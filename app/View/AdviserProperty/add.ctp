<style>
  #map-canvas {
    margin: 0 auto;
    padding: 0;
    height: 400px;
    width: 80%;
  }
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
// Enable the visual refresh
google.maps.visualRefresh = true;

var geocoder;
var map;
var markersArray = [];

function initialize() {
  geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 5,
        center: new google.maps.LatLng(22.913,-101.929),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    
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
	deleteOverlays();
	var marker = new google.maps.Marker({
	    position: location,
	    map: map
	});
	markersArray.push(marker);
	markersArray[0].setMap(map);
	var latitude;
	var longitude;
	var i = 0;
	for(var propertyName in location) {
		if(i==0)
			latitude = location[propertyName];
		else if(i==1)
			longitude = location[propertyName];
		else
			break;
		i++;	   
	}
	$('AdviserPropertyLatitude').value = latitude;
	$('AdviserPropertyLongitude').value = longitude;
}

function codeAddress(address) {
	var zoom = 14;
	geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            map.setZoom(zoom);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}
</script>
<div>
	<h3>Datos de propiedad</h3>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>  
	<br>
	<h4>Ubicaci&oacute;n</h4>
	<?php echo $this->Form->create('AddProperty');?>
	<input type="text" id="AuxAddress">
	<div id="map-canvas"></div>
	<?php echo $this->Form->input('AdviserProperty.latitude', array('type'=>'hidden'));?>
	<?php echo $this->Form->input('AdviserProperty.longitude', array('type'=>'hidden'));?>
	<h4>Im&aacute;genes</h4>
	<?php echo $this->Form->input('PropertyImage.0.image', array('label'=>'Imagen 1', 'type'=>'file'));?>
	<?php echo $this->Form->input('PropertyImage.1.image', array('label'=>'Imagen 2','type'=>'file'));?>
	<?php echo $this->Form->input('PropertyImage.2.image', array('label'=>'Imagen 3','type'=>'file'));?>
	<?php echo $this->Form->input('PropertyImage.3.image', array('label'=>'Imagen 4','type'=>'file'));?>
	<label id="adder" style="cursor:pointer;">Agregar otra imagen</label>
	<div id="adderContainer"></div>
</div>

<script>
	var id = 4;
	$('adder').observe('click', function(){
		$('adderContainer').insert(new Element('input',{
			type: 	'file',
			name: 	'data[PropertyImage]['+id+'][image]',
			id: 	'PropertyImage'+id+'Image'
		}));
		id++;
	});

	$('AuxAddress').observe('change', function(){
		codeAddress($('AuxAddress').value);
	});
</script>