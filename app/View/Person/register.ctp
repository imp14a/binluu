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
                <div class="input select">
                    <select id="PersonProfileOcupation" name="data[PersonProfile][ocupation]" class="optionEmpty">
                        <option disabled selected value="N">Ocupaci&oacute;n</option>
                        <?php foreach($ocupations as $ocupation):?>
                            <option value="<?php echo $ocupation['name']; ?>"><?php echo $ocupation['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="input select">
                    <select id="PersonProfileTransport" name="data[PersonProfile][transport]" class="optionEmpty">
                        <option disabled selected value="N">Medio de transporte</option>
                        <?php foreach($transports as $transport):?>
                            <option value="<?php echo $transport['name']; ?>"><?php echo $transport['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="tagContainer" id="tagContainer">
                    <div class="showTagsButton" id="showTagsButton"></div>
                    <span style="color:#999; margin-top: 4px; margin-left: 30px; display: inline-block;" id="emptyIntereses">Intereses</span>
                </div>
                <div class="sexQuestion" id="sexQuestion">
                    <?php echo $this->Form->hidden('PersonProfile.alow_both_sex');?>
                    <div class="optionButton" value="1">Si</div>
                    <div class="optionButton" value="0">No</div>
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
    
    $("UserProfileSex").observe('change',function () {
        if($(this).value == "N") $(this).addClassName("optionEmpty");
        else $(this).removeClassName("optionEmpty");
    });
    $("PersonProfileOcupation").observe('change',function () {
        if($(this).value == "N") $(this).addClassName("optionEmpty");
        else $(this).removeClassName("optionEmpty");
    });
    $("PersonProfileTransport").observe('change',function () {
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
var stepProcess = new BinluuProcess('stepProces');

var binluuSimpleQuestion = new BinluuSimpleQuestion('sexQuestion',{
    optionSelector:".optionButton",
    changeOption:function(value){
        $('PersonProfileAlowBothSex').setValue(value);
    }
});

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
        if($('tagContainer').select('input').length>0){
            $('tagContainer').select('input').each(function(input,indx){
                $(input).writeAttribute('id','PersonProfileCategoryTag'+indx);
                $(input).writeAttribute('name','data[PersonProfile]['+indx+'][CategoryTag][id]');
            });
            $('emptyIntereses').hide();
        }else{
             $('emptyIntereses').show();
        }
        
    }

});

</script>