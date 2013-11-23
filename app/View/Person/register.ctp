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
    body{
        font-family: StoneSansStd-Medium;
    }
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
        padding-top: 3px;
        margin-top: 40px;
        margin-right: 30px;
        float: right;
    }
    .tagContainer{
        width: 80%;
        height: 80px;
        background-color: white;
        margin-top: 20px;
        margin-left: 10%;
        overflow: auto;
    }
    .showTagsButton{
        background-image: url('/img/open_tags.png');
        width: 18px;
        height: 18px;
        cursor: pointer;
        float: right;
        margin-right: 4px;
        margin-top: 4px;
    }
    .alternateBox{
        width: 600px;
        height: 620px;
        display: inline-block;
        background-image: url('/img/register_image.png');
        background-size: cover;
    }
    .sexQuestion{
        width: 80%;
        height: 84px;
        background-image: url('/img/register_question.png');
        margin-left: 10%;
        margin-top: 20px;
        background-repeat: no-repeat;
        background-color: white;
    }
    .optionButton{
        background-color: #ff6300;
        margin-top: 10px;
        float: right;
        clear: right;
        width: 60px;
        color: white;
        font-family: StoneSansStd-MediumItalic;
    }
    .submit{
        margin-top: 60px;
        border: none;
        background-image: url('/img/submit_register.png');
        background-color: white;
        width: 165px;
        height: 43px;
        cursor: pointer;
    }
    .inforegister{
        margin-top: 20px;
        color: #999999;
        font-size: 12pt;
    }
    .inforegister a{
        color: #FF6400;
        text-decoration: none;
    }
    .tagSelector{
        background-image: url('/img/background_tags');
        background-size: contain;
        margin-top: 100px;
        height: 270px;
        border-radius: 20px;
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        width: 550px;
        padding: 20px;
        text-align: justify;
    }
    .tag{
        cursor: pointer;
        margin-top: 5px;
        display: inline-block;
        padding: 4px;
        background-color: white;
        border: 3px solid #999;
        border-radius: 15px;
        background: #dcdcdc; /* Old browsers */
        background: -moz-linear-gradient(top, #dcdcdc 0%, #ffffff 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#dcdcdc), color-stop(100%,#ffffff));
        background: -webkit-linear-gradient(top, #dcdcdc 0%,#ffffff 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #dcdcdc 0%,#ffffff 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #dcdcdc 0%,#ffffff 100%); /* IE10+ */
        background: linear-gradient(to bottom, #dcdcdc 0%,#ffffff 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dcdcdc', endColorstr='#ffffff',GradientType=0 );
    }
    .tag.selected{
        border: 3px solid #F8C175;
        background: #ff6400; /* Old browsers */
        background: -moz-linear-gradient(top, #ff6400 0%, #f49719 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff6400), color-stop(100%,#f49719));
        background: -webkit-linear-gradient(top, #ff6400 0%,#f49719 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #ff6400 0%,#f49719 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #ff6400 0%,#f49719 100%); /* IE10+ */
        background: linear-gradient(to bottom, #ff6400 0%,#f49719 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff6400', endColorstr='#f49719',GradientType=0 );
    }
    .usedTag{
        background-color: #e4e4e4;
        padding: 3px;
        border-radius: 12px;
        padding-left: 6px;
        padding-right: 6px;
        display: inline-block;
        margin-top: 2px;
        font-size: 10pt;
        margin-left: 4px;
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
                     <?php echo $this->Form->input('PersonProfile.min_budget', array('label' => 'Desde','value'=>'$ 500.00','readonly',"class"=>"midle")); ?>
                     <?php echo $this->Form->input('PersonProfile.max_budget', array('label' => 'Hasta','value'=>'$ 12,000.00','readonly',"class"=>"midle")); ?>
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
            
            <div class="information container" style="height: 440px;">
                <span class="title" style="margin-top:60px;">Para poder mostrarte recomendaciones personalizadas, &iexcl;Cuent&aacute;nos m&aacute; de t&iacute; &excl; </span>
                <?php echo $this->Form->input("PersonProfile.ocupation",array('label'=>false,'placeholder'=>"Ocupación")); ?>
                <?php echo $this->Form->input('PersonProfile.transport', array('label'=>false,'placeholder'=>"Medio de transporte")); ?>
                <div class="tagContainer" id="tagContainer">
                    <div class="showTagsButton" id="showTagsButton"></div>
                </div>
                <div class="sexQuestion">
                    <div class="optionButton">Si</div>
                    <div class="optionButton">No</div>
                </div>
                <button type=="submit" class="submit"></button>
                <p class="inforegister">
                    Al hacer clic en Registrarme, aceptas los <?php echo $this->Html->link("Términos y condiciones",array("controller"=>"Bonluu","action"=>"terms"));?> y que has leido la <?php echo $this->Html->link("Políticas de uso de datos",array("controller"=>"Bonluu","action"=>"politics"));?>
                </p>
            </div>
            <div class="alternateBox">
                <div class="tagSelector" id="tagSelector">
                    <?php foreach($tags as $tag): ?>
                        <span class="tag" id="<?php echo $tag['id']; ?>"><?php echo $tag['name']?></span>
                    <?php endforeach;?>
                </div>
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

var binluuTagSelector = new BinluuTagSelector('tagSelector',{
    actionButton:'showTagsButton',
    tagChanged: function(tag,remove){
        if(remove){
            $('tagContainer').select("#"+$(tag).readAttribute('id')).each(function(t){
                $(t).remove();
            });
        }else{
            $('tagContainer').insert({
                bottom: new Element('span',{id:$(tag).readAttribute('id'),class:"usedTag"}).update($(tag).innerHTML)
                    .insert({
                        bottom: new Element('input',{type:'hidden',value:$(tag).readAttribute('id')})
                    })
            });
        }
        $('tagContainer').select('input').each(function(input,indx){
            $(input).writeAttribute('id','PersonProfileCategoryTag'+indx);
            $(input).writeAttribute('name','data[PersonProfile][CategoryTag]['+indx+']');
        });
    }

});

</script>