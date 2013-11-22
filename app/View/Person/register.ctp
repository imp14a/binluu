<?php 

    echo $this->Html->css('binluu.components');
    echo $this->Html->css('binluu.default');
    echo $this->Html->script('bonluu.components');
  
?>

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
        width: 50%;
        display: inline-block;
        height: 500px;
    }
    .information{
        width: 420px;
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
    <div id="stepProces" class="stepProces">
        <?php echo $this->Form->create("Register"); ?>
        <div class="step" id="1">
            <div class="information container">
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
                    <div class="slider_input">
                        <div class="slider_container">
                            <div id="slider" class="slider">
                            <div class="handle"></div>
                            <div class="handle"></div>
                            <div id="id_range" class="range"></div>
                        </div>
                    </div>
                     <?php echo $this->Form->input('min_price', array('label' => 'Desde','value'=>'el menor precio','readonly')); ?>
                     <?php echo $this->Form->input('max_price', array('label' => 'Hasta','value'=>'el mayor precio','readonly')); ?>
                 </div>
                </div>
                <div class="captcha">
                    <?php
                        echo $captcha;
                    ?>
                </div>
            </div>
            <div class="map container">
                <?php echo $this->Form->hidden("IdealProperty.latitude"); ?>
                <?php echo $this->Form->hidden("IdealProperty.longitude"); ?>
                <div id="map-canvas"></div>
                <p>Indica en el mapa donde deseas vivir se creara un radio de 1.5km a partir del punto que escojas</p>
            </div>
            <a href="javascript:void(0)" class="next" step="2">Siguiente</a>
        </div>            
        <div class="step" id="2">
            <div class="information container">
                <?php echo $this->Form->input("PersonProfile.ocupation"); ?>
                <?php echo $this->Form->input('PersonProfile.transport', array('label'=>false,"rows"=>"9")); ?>
                <textarea id="Interest"></textarea>
                <?php echo $this->Form->textarea('PersonProfile.interest', array('label'=>false,"rows"=>"9")); ?>
            </div>
            <button type=="submit" >Registrame</button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
	
</div>
<script>
var slider = new BinluuSlider('slider',
                    [   'PropertySearchMinPrice',
                        'PropertySearchMaxPrice'
                    ],
                    {
                        rangeValues : [0,15,20,25,30,35,40,50,55],
                        minLabel : "el menor precio",
                        maxLabel : "el mayor precio",
                        concurrency : { coinSimbol: "$",sufijo: ",000.00"}
                    }
                );
                    
var stepProcess = new BinluuProcess('stepProces');

</script>