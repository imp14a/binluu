<style>
  #map-canvas {
    margin: 0 auto;
    padding: 0;
    height: 400px;
    width: 80%;
  }
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>

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
    
  	var input = /** @type {HTMLInputElement} */(document.getElementById('searchTextField'));
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('searchTextField'), { types: [ 'geocode' ] });

  	autocomplete.bindTo('bounds', map)

	google.maps.event.addListener(autocomplete, 'place_changed', function() {
	    var place = autocomplete.getPlace();
	    if (!place.geometry) {
	      input.className = 'notfound';
	      return;
	    }
	    if (place.geometry.viewport) {
	      map.fitBounds(place.geometry.viewport);
	    } else {
	      map.setCenter(place.geometry.location);
	      map.setZoom(13);  // Why 13? Because it looks good.
    	}
	});

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
	var zoom = 13;
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
	<?php echo $this->Html->link('REGRESAR', array('action'=>'index'));?>
	<?php echo $this->Form->create('AddProperty', array('type'=>'file'));?>
	<h4>Descripci&oacute;n</h4>
	<?php echo $this->Form->input('AdviserProperty.description', array('label'=>false));?>
	<h4>Direcci&oacute;n</h4>
	<?php echo $this->Form->input('AdviserProperty.address', array('label'=>false, 'style'=>'width: 225px;')); ?>
	<h4>Ubicaci&oacute;n</h4>
	<div class="addresssearch" style="width:80%;">
		<input id="searchTextField" placeholder="Introduce una ubicación" type="text" autocomplete="off" style="margin: 0 auto;position: relative;width: 99.5%;left: 12.5%;">
	</div>
	<div id="map-canvas"></div>
	<?php echo $this->Form->input('AdviserProperty.latitude', array('type'=>'hidden'));?>
	<?php echo $this->Form->input('AdviserProperty.longitude', array('type'=>'hidden'));?>
	<h4>Im&aacute;genes</h4>
	<?php echo $this->Form->input('DefaultImage.image', array('label'=>'Imagen Default', 'type'=>'file'));?>
	<?php echo $this->Form->input('DefaultImage.type', array('type'=>'hidden', 'value'=>'default'));?>
	<?php echo $this->Form->input('PropertyImage.0.image', array('label'=>'Imagen 1','type'=>'file'));?>
	<?php echo $this->Form->input('PropertyImage.0.type', array('type'=>'hidden', 'value'=>'description'));?>
	<?php echo $this->Form->input('PropertyImage.1.image', array('label'=>'Imagen 2','type'=>'file'));?>
	<?php echo $this->Form->input('PropertyImage.1.type', array('type'=>'hidden', 'value'=>'description'));?>
	<?php echo $this->Form->input('PropertyImage.2.image', array('label'=>'Imagen 3','type'=>'file'));?>
	<?php echo $this->Form->input('PropertyImage.2.type', array('type'=>'hidden', 'value'=>'description'));?>
	<?php echo $this->Form->input('PropertyImage.3.image', array('label'=>'Imagen 4','type'=>'file'));?>
	<?php echo $this->Form->input('PropertyImage.3.type', array('type'=>'hidden', 'value'=>'description'));?>
	<button id="adder" type="button">Agregar otra imagen</button>
	<div id="adderContainer"></div>
	<?php echo $this->Form->end('GUARDAR PROPIEDAD');?>
</div>

<script>
	var id = 4;
	$('adder').observe('click', function(){
		$('adderContainer').insert(new Element('input',{
			type: 	'file',
			name: 	'data[PropertyImage]['+id+'][image]',
			id: 	'PropertyImage'+id+'Image',
			style: 'display:block;' 
		}));
		id++;
	});
</script>