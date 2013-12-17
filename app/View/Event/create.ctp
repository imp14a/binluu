<?php echo $this->Html->css('binluu.components'); ?>
<?php echo $this->Html->css('adviser.events'); ?>
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
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
  	/*var input = /** @type {HTMLInputElement} *//*(document.getElementById('searchTextField'));
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('searchTextField'), { types: [ 'geocode' ] });

  	autocomplete.bindTo('bounds', map)*/

	/*google.maps.event.addListener(autocomplete, 'place_changed', function() {
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
	});*/

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

<style type="text/css">
#content{
	min-height: 470px;
}
</style>

<?php $this->layout = 'adviser'; ?>
<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
<br>
<div class="event_creation">
    <div class="back_img">
	    <p class="desc_title">Intoduzca los datos y escoja una ubicaci&oacute;n</p>
	    <?php echo $this->Form->create('Event', array('type'=>'file')); ?>
	    <div class="left">
		    <?php echo $this->Form->input('Event.name', array('label'=>false, 'placeholder'=>'Nombre del evento', 'style'=>'min-width:300px; display:block;width: 100%;')); ?>
		    <?php echo $this->Form->input('AdviserProperty.address', array('label'=>false, 'placeholder'=>'Dirección', 'style'=>'min-width:300px; display:block;width: 100%;')); ?>
		    <?php echo $this->Form->input('AdviserProperty.latitude', array('type'=>'hidden'));?>
				<?php echo $this->Form->input('AdviserProperty.longitude', array('type'=>'hidden'));?>
		    <?php echo $this->Form->input('Event.date', array('label'=>false, 'placeholder'=>'Fecha', 'style'=>'width:100px')); ?>
	    </div>
	    <div class="right">
		    <?php echo $this->Form->textarea('Event.property_description', array('label'=>false,'rows'=>'3', 'placeholder'=>'Descripción del inmueble', 'style'=>'width:100%; height: 64px;margin-top: 2px;')); ?>
	    </div>
	    <div class="details">
		    <div id="map">
		    </div>
		    <div class="images_files">
			    <p>Suba dos fotos del lugar</p>	
			    <div class="img_box">			    
			        <?php echo $this->Form->input('PropertyImage.0.image', array('label'=>false , 'type'=>'file','required'=>'required', 'style'=>'opacity:0;')); ?>
			        <?php echo $this->Form->input('PropertyImage.0.type', array('type'=>'hidden', 'value'=>'description')); ?>
			    </div>
			    <div class="img_box">
			        <?php echo $this->Form->input('PropertyImage.1.image', array('label'=>false, 'type'=>'file', 'required'=>'required', 'style'=>'opacity:0;')); ?>
			        <?php echo $this->Form->input('PropertyImage.1.type', array('type'=>'hidden', 'value'=>'description')); ?>
			    </div>		
		    </div>
	    </div>
	    <div class="action">
			    <?php echo $this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'cancel')); ?>
			    <?php echo $this->Form->end("Siguiente >", array('formnovalidate'=>'formnovalidate')); ?>
	    </div>
	</div>
</div>