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
    .stepProces{
        display: inline-block;
    }
    .step{
        border:2px solid #ff6400;
    }
    .container{
        width: 50%;
        display: inline-block;
    }
    .information{
        float: left;
        width: 400px;
        background-color: #ff6400;
        background-image: url('/img/information_background.png');
        background-size: cover;
        text-align: center;
        height: 620px;
    }
    .map{
        text-align: center;
        width: 600px;
        height: 620px;
    }
    #map-canvas{
        width: 100%;
        height: 70%;
    }
    .mapdetail{
        width: 100%;
        height: 28px;
        background-image: url('/img/map_detail.png');
        background-repeat: no-repeat;
        background-position: center;
    }
    .mapinfo{
        font-family: StoneSansStd-Medium;
        font-size: 13pt;
        color: #6E6E6E;
    }
    .input input[type=text]{
        height: 28px;
    }
    .half{
        width:40% !important;
    }
    .midle{
        margin-left: 15px;
        margin-right: 5px;
        width: 25% !important;
        padding-left: 5px !important;
        color: #999;
    }
    .backButton{
        width: 80px;
        height: 28px;
        line-height: 28px;
        display: block;
        font-family: StoneSansStd-Medium;
        padding-left: 5px;
        text-decoration: none;
        color: #ff6400;
        border: 1px solid #ff6400;
        margin-bottom: 10px;
        padding-right: 5px;
        padding-top: 3px;
    }
    .optionEmpty{
        color: #999;
    }
    option:first-child{
        color: #999;
    }
    option{
        color: black;
    }
    .slider_input{
        margin-top: 15px;
        width: 80%;
        margin-left: 10%;
        font-family: StoneSansStd-Medium;
        font-size: 13pt;
        color: white;
    }
    .slider_input .legend{
        width: 100%;
        text-align: left;
        display: block;
        margin-bottom: 10px;
        padding-left: 10%;
    }
    .captcha{
        width: 80%;
        margin-left: 10%;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .next{
        background-image: url('/img/next_button.png');
        width: 90px;
        height: 28px;
        display: block;
        text-decoration: none;
        color: white;
        line-height: 28px;
        background-size: cover;
        padding-left: 10px;
        text-align: left;
        font-family: StoneSansStd-Medium;
        padding-top: 3px;
        margin-top: 40px;
        margin-right: 30px;
        float: right;
    }
    textarea{
        width: 80%;
        height: 80px;
        margin-top: 20px;
        padding-top: 10px;
        padding-left: 30px;
    }
</style>
<div style="margin-left: 15%;">
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
                    echo $this->Form->select('sex', $options,array('disabled' => array('N'),"value"=>"N","class"=>"optionEmpty half",'empty'=>false));  ?>
                </div>
                <?php echo $this->Form->input("User.username",array("type"=>"email",'label'=>false,"placeholder"=>"Correo electrónico")); ?>
                <?php echo $this->Form->password("User.password",array('placeholder'=>"Contraseña"))?>
                <?php echo $this->Form->password("User.password_confirm",array('placeholder'=>"Repite tu contraseña")); ?>
                <div class="slider_input">
                    <span class="legend">Presupuesto</span>
                    <div class="slider_container">
                        <div id="slider" class="slider">
                            <div class="handle"></div>
                            <div class="handle"></div>
                            <div class="top" style="left: -3%;"></div>
                            <div id="id_range" class="range"></div>
                            <div class="top" style="left: 97%;"></div>
                        </div>
                    </div>
                     <?php echo $this->Form->input('min_price', array('label' => 'Desde','value'=>'$ 500.00','readonly',"class"=>"midle")); ?>
                     <?php echo $this->Form->input('max_price', array('label' => 'Hasta','value'=>'$ 12,000.00','readonly',"class"=>"midle")); ?>
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
                <a href="javascript:void(0)" class="next" step="2">Siguiente</a>
            </div>
        </div>            
        <div class="step" id="2">
            
            <div class="information container">
                <span class="title" style="margin-top:60px;">Para poder mostrarte recomendaciones personalizadas, &iexcl;Cuent&aacute;nos m&aacute; de t&iacute; &excl; </span>
                <?php echo $this->Form->input("PersonProfile.ocupation",array('label'=>false,'placeholder'=>"Ocupación")); ?>
                <?php echo $this->Form->input('PersonProfile.transport', array('label'=>false,'placeholder'=>"Medio de transporte")); ?>
                <?php echo $this->Form->textarea('PersonProfile.interest', array('label'=>false,"rows"=>"4","placeholder"=>"Intereses")); ?>
                <button type=="submit" >Registrarme</button>
                <p class="inforegistr">
                    Al hacer clic en Registrarme, aceptas los <?php echo $this->Html->link("Términos y condiciones",array("controller"=>"Bonluu","action"=>"terms"));?> y que has leido la <?php echo $this->Html->link("Políticas de uso de datos",array("controller"=>"Bonluu","action"=>"politics"));?>
                </p>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
	
</div>
<script>
    
    $("RegisterSex").observe('change',function () {
        if($(this).value == "N") $(this).addClassName("optionEmpty");
        else $(this).removeClassName("optionEmpty");
    });
var slider = new BinluuSlider('slider',
                    [   'RegisterMinPrice',
                        'RegisterMaxPrice'
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
                    
var stepProcess = new BinluuProcess('stepProces');

</script>