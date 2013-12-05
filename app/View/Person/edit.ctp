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
    .submit{
        display: inline;
        width: 100%;
        display: block;
        background: none;
        margin-top: 20px;
        text-align: left;
        padding-left: 25px;
    }
    .submit input{
        border: none;
        background-color: white;
        width: 40%;
        height: 28px;
    }
    .imageprofile img{
        display: inline-block;
        float: left;
        border: 1px solid white;
        margin-left: 25px;
        margin-right: 5px;
    }
    .imageprofile .input.file{
        display: inline-block;
        float: left;
        margin-top: 60px;
        margin-bottom: 5px;
    }
    .binluuTabs{
        text-align: center;
        margin-top: 10px;
    }
    .binluuTabs .tabs{
        padding-left: 10px;
        margin-top: 10px;
        width: 1004px;
        text-align: left;
        display: inline-block;
    }
    .binluuTabs .tabs .tab{
        height: 36px;
        display: inline-block;
        line-height: 36px;
        border: 1px solid #ff6400;
        border-bottom: none;
        padding-left: 10px;
        padding-right: 10px;
        border-radius: 5px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        text-decoration: none;
        color: #ff6400;
    }
    .deactivate{
        height: 28px;
        float: right;
        margin-right: 20px;
        margin-top: 60px;
        text-decoration: none;
        color: #FF6400;
        font-size: 14pt;
    }
    .updateOfline{
        
    }
</style>

<div id="binluuTabs" class="binluuTabs" >
    <div class="tabs">
        <a class="tab" for="basicInformation" id="" href="javascript:void(0);">Informaci&oacute;n b&aacute;sica</a>
        <a class="tab" for="profile" href="javascript:void(0);">Perfil</a>
    </div>
    <div class="tabsContent">
        <div style="text-align: center;" id="basicInformation" class="content" >
            <div id="stepProces" class="stepProces">
                <div class="step" id="1">
                    <div class="information container">
                        <div class="background"></div>
                        <div class="detail"></div>
                        <?php echo $this->Form->create("Edit"); ?>
                            <?php echo $this->Form->input("User.name",array('label'=>false,'placeholder'=>"Nombre","value"=>$person['User']['name'])); ?>
                            <?php echo $this->Form->input("User.last_name",array('label'=>false,'placeholder'=>"Apellidos","value"=>$person['User']['last_name'])); ?>
                                    <?php echo $this->Form->input("PersonProfile.age",array('label'=>false,'placeholder'=>"Edad",'class'=>"half", "min"=>14,"max"=>100,"value"=>$person['PersonProfile']['age'])); ?>
                            <div class="input select">
                                <?php $options = array('N'=>'Sexo','M' => 'Masculino', 'F' => 'Femenino'); 
                                echo $this->Form->select('PersonProfile.sex', $options,array('disabled' => array('N'),"class"=>"half",'empty'=>false,"value"=>$person['PersonProfile']['sex']));  ?>
                            </div>
                            <?php echo $this->Form->hidden("IdealProperty.latitude",array("value"=>$person['IdealProperty']['latitude'])); ?>
                            <?php echo $this->Form->hidden("IdealProperty.longitude",array("value"=>$person['IdealProperty']['longitude'])); ?>
                            <div class="input select" style="width:100%; text-align: left; display: block; width: 100%; padding-left: 25px;">
                                 <?php $options = array("N"=>"Presupuesto","500.00"=>'$ 500.00',"1000.00"=>"$ 1,000.00","2000.00"=>"$ 2,000.00","3000.00"=>"$ 3,000.00","4000.00"=>"$ 4,000.00","5000.00"=>"$ 5,000.00","6000.00"=>"$ 6,000.00","8000.00"=>"$ 8,000.00","10000.00"=>"$ 10,000.00","12000.00"=>"$ 12,000.00","15000.00"=>"$ +12,000.00"); 
                                 echo $this->Form->select('PersonProfile.budget',$options, array('disabled' => array('N'),$person['PersonProfile']['budget'],"class"=>"half","empty"=>false)); ?>
                            </div>
                        <?php echo $this->Form->end("Actualizar Información")?>
                        <?php echo $this->Form->create(null,array('url' => array('controller'=>'User','action'=>'password','Person', $person['User']['id']))); ?>
                            <?php echo $this->Form->input("User.username",array("type"=>"email",'label'=>false,"placeholder"=>"Correo electrónico",'value'=>$person['User']['username'],'disabled'=>'disabled')); ?>
                            <?php echo $this->Form->password("User.password",array('placeholder'=>"Nueva Contraseña"))?>
                            <?php echo $this->Form->password("User.password_confirm",array('placeholder'=>"Repite tu contraseña")); ?>
                        <?php echo $this->Form->end("Actualizar Contraseña")?>
                        <div class="imageprofile" style="text-align:left;">
                            <?php echo $this->Form->create(null,array('url' => array('controller'=>'User','action'=>'image','Person', $person['User']['id']), 'type'=>'file')); ?>
                                    <?php 
                                            $sex = $person['PersonProfile']['sex'];				
                                            $image = $person['User']['image']===null?$sex==='M'?'default_img_male.png':'default_img_female.png':$person['User']['image'];
                                            $image = '/files/'.$image;
                                            echo $this->Html->image($image); ?>
                                    <?php echo $this->Form->input('User.image', array('label'=>false, 'type'=>'file')) ;?>
                            <?php echo $this->Form->end('Actualizar imagen'); ?>
                        </div>
                    </div>
                    <div class="map container">
                        <div id="map-canvas"></div>
                        <div class="mapdetail"></div>
                        <p class="mapinfo">Indica en el mapa donde deseas vivir se creara un radio de 1.5km a partir del punto que escojas</p>
                        <?php echo $this->Form->postLink("Desactivar Cuenta", 
                                array('controller'=>'User', 'action' => 'delete', $person['User']['id']), 
                                array('confirm' => '¿Deseas desactivar tu cuenta?','class'=>'deactivate'));
                        ?>
                    </div>
                </div>
                 <?php echo $this->Form->end(); ?>

            </div>
        </div>
    </div>
    <div class="content" style="text-align: center;" id="profile">
        <div class="stepProces">
            <div class="step">
                <?php echo $this->Form->create("Edit"); ?>
                <?php echo $this->Form->hidden('PersonProfile.id',array('value'=>$person['PersonProfile']['id']));?>
                <div class="information container" style="height: 440px;">
                    <div class="background"></div>
                    <div class="detail"></div>
                    <div class="input select">
                        <select id="PersonProfileOcupation" name="data[PersonProfile][ocupation]" class="">
                            <option disabled value="N">Ocupaci&oacute;n</option>
                            <?php foreach($ocupations as $ocupation):?>
                                <?php if($person['PersonProfile']['ocupation']==$ocupation['name']):?>
                                    <option value="<?php echo $ocupation['name']; ?>" selected><?php echo $ocupation['name']?></option>
                                <?php else:?>
                                    <option value="<?php echo $ocupation['name']; ?>"><?php echo $ocupation['name']?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="input select">
                        <select id="PersonProfileTransport" name="data[PersonProfile][transport]" class="">
                            <option disabled value="N">Medio de transporte</option>
                            <?php foreach($transports as $transport):?>
                                <?php if($person['PersonProfile']['transport']==$transport['name']):?>
                                    <option value="<?php echo $ocupation['name']; ?>" selected><?php echo $ocupation['name']?></option>
                                <?php else:?>
                                    <option value="<?php echo $transport['name']; ?>" ><?php echo $transport['name']?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="tagContainer" id="tagContainer">
                        <div class="showTagsButton" id="showTagsButton"></div>
                        <?php $ix=0; foreach($userTags as $utag):?>
                            <span class="usedTag" id="<?php echo $utag['category_tag_id']; ?>">
                                <?php echo $utag['tag']; ?>
                                <input type="hidden" value="<?php echo $person['PersonProfile']['id']?>" ele="usr" name="data[PersonProfileTag][<?php echo $ix; ?>][person_profile_id]" />
                                <input type="hidden" value="<?php echo $utag['tag']; ?>" ele="tag" name="data[PersonProfileTag][<?php echo $ix; ?>][category_tag_id]" />
                                <input type="hidden" value="<?php echo $utag['category_tag_id']; ?>" ele="category_tag_id" name="data[PersonProfileTag][<?php echo $ix;?>][id]" />
                            </span>
                        <?php $ix++; endforeach;?>
                    </div>
                    <div class="sexQuestion" id="sexQuestion">
                        <?php echo $this->Form->hidden('PersonProfile.alow_both_sex',array("value"=>$person['PersonProfile']['alow_both_sex']));?>
                        <div class="optionButton" value="1">Si</div>
                        <div class="optionButton" value="0">No</div>
                    </div>
                    <div class="submit" style="margin-left: 15px;">
                        <input type="submit" class="submit" value="Actualizar Perfil" style="width: 30%;">
                    </div>
                    <p class="inforegister" style="margin-top: 110px;">
                        Leer los <?php echo $this->Html->link("Términos y condiciones",array("controller"=>"Binluu","action"=>"terms"));?> y las <?php echo $this->Html->link("Políticas de uso de datos",array("controller"=>"Binluu","action"=>"politics"));?>
                    </p>
                </div>
                <div class="alternateBox">
                    <div class="tagSelector" id="tagSelector">
                        <?php foreach($tags as $tag): ?>
                            <span class="tag" id="<?php echo $tag['id']; ?>"><?php echo $tag['name']?></span>
                        <?php endforeach;?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
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
    
    valueSaved = $('PersonProfileAlowBothSex').getValue()!=""?$('PersonProfileAlowBothSex').getValue():0;
    var binluuSimpleQuestion = new BinluuSimpleQuestion('sexQuestion',{
        optionSelector:".optionButton",
        value:valueSaved,
        changeOption:function(value){
            $('PersonProfileAlowBothSex').setValue(value);
        }
    });

var binluuTagSelector = new BinluuTagSelector('tagSelector',{
    actionButton:'showTagsButton',
    initElementsFrom:"tagContainer",        
    tagChanged: function(tag,remove){
        if(remove){
            $('tagContainer').select("#"+$(tag).readAttribute('id')).each(function(t){
                $(t).remove();
            });
        }else{
            var usrId =$('PersonProfileId').value;
            $('tagContainer').insert({
                bottom: new Element('span',{id:$(tag).readAttribute('id'),class:"usedTag"}).update($(tag).innerHTML)
                    .insert({
                        bottom: new Element('input',{type:'hidden',value:$(tag).innerHTML,ele:"tag"})
                    })
                    .insert({
                        bottom: new Element('input',{type:'hidden',value:$(tag).id,'ele':"category_tag_id"})
                    })
                    .insert({
                        bottom: new Element('input',{type:'hidden',value:usrId,'ele':"usr"})
                    })
            });
        }
        if($('tagContainer').select('input').length>0){
            var indxT=0;
            var indxC=0;
            var indxU=0;
            $('tagContainer').select('input').each(function(input,indx){
                if($(input).readAttribute('ele')=="tag"){
                    $(input).writeAttribute('name','data[PersonProfileTag]['+indxT+'][tag]');
                    indxT++;
                }
                else if($(input).readAttribute('ele')=="usr"){
                    $(input).writeAttribute('name','data[PersonProfileTag]['+indxU+'][person_profile_id]');
                    indxU++;
                }
                else{
                    $(input).writeAttribute('name','data[PersonProfileTag]['+indxC+'][category_tag_id]');
                    indxC++;
                }
            });
        }else{
        }
        
    }

});

$$('.content').each(function(content){
    $(content).hide();
});
$('basicInformation').show();

$$('.tab').each(function(tab){
    $(tab).observe('click',function(){
        $$('.content').each(function(content){
            $(content).hide();
        });
        var openId = $(this).readAttribute('for');
        $(openId).show();
    });
});

</script>