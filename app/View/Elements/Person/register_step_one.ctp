<?php 

    echo $this->Html->css('binluu.components');
    echo $this->Html->css('binluu.default');
    echo $this->Html->css('binluu.register');
    echo $this->Html->script('binluu.components');
  
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
    .errorRequired{
        border:1px solid red;
    }
</style>
<div style="text-align: center;">
    <?php echo $this->Html->link("< Regresar",array('controller'=>"User",'action'=>"login"),array('class'=>'backButton'));?>
    <div id="stepProces" class="stepProces">
        <?php echo $this->Form->create("Register"); ?>
        <div class="step" id="1">
            <div class="information container">
                <span class="title">Informaci&oacute;n b&aacute;sica</span>
                <?php echo $this->Form->input("User.name",array('label'=>false,'placeholder'=>"Nombre")); ?>
                <?php echo $this->Form->input("User.last_name",array('label'=>false,'placeholder'=>"Apellidos")); ?>
		        <?php echo $this->Form->input("PersonProfile.age",array('label'=>false,'placeholder'=>"Edad",'class'=>"half", "min"=>14,"max"=>100)); ?>
                <div class="input select">
                    <?php $options = array('N'=>'Sexo','M' => 'Masculino', 'F' => 'Femenino'); 
                    echo $this->Form->select('PersonProfile.sex', $options,array('disabled' => array('N'),"value"=>"N","class"=>"optionEmpty half",'empty'=>false));  ?>
                </div>
                <?php echo $this->Form->input("User.username",array("type"=>"email",'label'=>false,"placeholder"=>"Correo electrónico")); ?>
                <?php echo $this->Form->password("User.password",array('placeholder'=>"Contraseña"))?>
                <?php echo $this->Form->password("User.password_confirm",array('placeholder'=>"Repite tu contraseña")); ?>
                <div class="input select" style="width:100%; text-align: left; display: block; width: 100%; padding-left: 25px;">
                     <?php $options = array("N"=>"Presupuesto","500.00"=>'$ 500.00',"1000.00"=>"$ 1,000.00","2000.00"=>"$ 2,000.00","3000.00"=>"$ 3,000.00","4000.00"=>"$ 4,000.00","5000.00"=>"$ 5,000.00","6000.00"=>"$ 6,000.00","8000.00"=>"$ 8,000.00","10000.00"=>"$ 10,000.00","12000.00"=>"$ 12,000.00","15000.00"=>"$ +12,000.00"); 
                     echo $this->Form->select('PersonProfile.budget',$options, array('disabled' => array('N'),'value'=>'N',"class"=>"optionEmpty half","empty"=>false)); ?>
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
                <div class="mapdetail"></div>
                <p class="mapinfo">Indica en el mapa donde deseas vivir se creara un radio de 1.5km a partir del punto que escojas</p>
                <button type="submit" class="next" >Siguiente</button>
            </div>
        </div>
         <?php echo $this->Form->end(); ?>
    </div>
</div>
<script>
    
    $("PersonProfileSex").observe('change',function () {
        if($(this).value == "N") $(this).addClassName("optionEmpty");
        else $(this).removeClassName("optionEmpty");
    });
    $("PersonProfileBudget").observe('change',function () {
        if($(this).value == "N") $(this).addClassName("optionEmpty");
        else $(this).removeClassName("optionEmpty");
    });

    var slider = new BinluuSlider('slider',
                    [   'PersonProfileMinBudget',
                        'PersonProfileMaxBudget'
                    ],
                    {
                        rangeValues : [0,1,2,3,4,5,6,7,8,9,10,11,12,13],
                        minLabel : "$ 500.00",
                        maxLabel : "+ $ 12,000.00",
                        concurrency : { coinSimbol: "$",sufijo: ",000.00"},
                        initMin:1,
                        initMax:12,
                        size:14
                    }
                );

</script>