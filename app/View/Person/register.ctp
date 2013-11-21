
<?php echo $this->Html->css('binluu.components'); ?>
<?php echo $this->Html->css('binluu.default'); ?>

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
<style>
    .step{
        border:2px solid #ff6400;
    }
    .container{
        display: box;
        width: 49%;
        display: inline-block;
        height: 500px;
    }
    .information{
        background-color: #ff6400;
    }
    .map{
        
        text-align: center;
    }
    #map-canvas{
        margin-left: 10%;
        width: 80%;
        height: 80%;
    }
    .input input[type=text]{
        height: 28px;
    }
    .grid50{
        width:49% !important;
    }
</style>
<div>
    <?php echo $this->Html->link("Regresar",array('controller'=>"User",'action'=>"login"));?>
    <div class="stepProces">
        <?php echo $this->Form->create("Register"); ?>
        <div class="step" step="1"><div class="information container">
                <span class="title">Informaci&oacute;n b&aacute;sica</span>
                <?php echo $this->Form->input("User.name",array('label'=>false,'placeholder'=>"Nombre")); ?>
                <?php echo $this->Form->input("User.last_name",array('label'=>false,'placeholder'=>"Apellidos")); ?>
		<?php echo $this->Form->input("PersonProfile.age",array('label'=>false,'placeholder'=>"Edad",'class'=>"grid50", "min"=>14,"max"=>100)); ?>
                <div class="input radio">
                    <span>Sexo</span>
                    <?php $options = array('M' => 'M', 'F' => 'F'); echo $this->Form->radio("PersonProfile.sex",$options,array('legend'=>false));  ?>
                </div>
                <?php echo $this->Form->input("User.username",array("type"=>"email",'label'=>false,"placeholder"=>"Correo electrónico")); ?>
                <?php echo $this->Form->password("User.password",array('placeholder'=>"Contraseña"))?>
                <?php echo $this->Form->password("User.password_confirm",array('placeholder'=>"Repite tu contraseña")); ?>
                <div>
                    <span>Presupuesto</span>
                    <span>Desde</span>
                    <?php echo $this->Form->input("PersonProfile.min_budget",array('label'=>false)); ?>
                    <span>Hasta</span>
                    <?php echo $this->Form->input("PersonProfile.max_budget",array('label'=>false)); ?>
                </div>
                <div class="captcha"></div>
            </div>
            <div class="map container">
                <?php echo $this->Form->hidden("IdealProperty.latitude"); ?>
                <?php echo $this->Form->hidden("IdealProperty.longitude"); ?>
                <div id="map-canvas"></div>
                <p>Indica en el mapa donde deseas vivir se creara un radio de 1.5km a partir del punto que escojas</p>
            </div></div>            
        <div class="step" step="2">
            <div class="information container">
                <?php echo $this->Form->input("PersonProfile.ocupation"); ?>
                <?php echo $this->Form->input('PersonProfile.transport', array('label'=>false,"rows"=>"9")); ?>
                <textarea id="Interest"></textarea>
                <?php echo $this->Form->textarea('PersonProfile.interest', array('label'=>false,"rows"=>"9")); ?>
            </div>
        </div>
        <?php echo $this->Form->end("¡Registrarme!")?>
    </div>
    <div class="profileinfo">
    </div>
	
</div>