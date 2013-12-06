<?php 

    echo $this->Html->css('binluu.components');
    echo $this->Html->css('binluu.default');
    echo $this->Html->css('binluu.register');
    echo $this->Html->script('binluu.components');
  
?>
<div style="text-align: center;">
    <?php echo $this->Html->link("< Regresar",array('controller'=>"User",'action'=>"login"),array('class'=>'backButton'));?>
    <div class="stepProces">
        <div class="step">
        <?php echo $this->Form->create("Register",
            array('url' => array('controller' => 'Person', 'action' => 'register',2,$person_profile_id))); ?>
            <?php echo $this->Form->hidden('PersonProfile.id',array('value'=>$person_profile_id));?>
            <div class="information container" style="height: 440px;">
                <div class="background"></div>
                <div class="detail"></div>
                <span class="title" style="margin-top:60px;font-size:15pt;">Para poder mostrarte recomendaciones personalizadas, &iexcl;Cuent&aacute;nos m&aacute; de t&iacute; &excl; </span>
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
                    Al hacer clic en Registrarme, aceptas los <?php echo $this->Html->link("Términos y condiciones",array("controller"=>"Binluu","action"=>"terms"));?> y que has leido la <?php echo $this->Html->link("Políticas de uso de datos",array("controller"=>"Binluu","action"=>"politics"));?>
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
<script>
    
    $("PersonProfileOcupation").observe('change',function () {
        if($(this).value == "N") $(this).addClassName("optionEmpty");
        else $(this).removeClassName("optionEmpty");
    });
    $("PersonProfileTransport").observe('change',function () {
        if($(this).value == "N") $(this).addClassName("optionEmpty");
        else $(this).removeClassName("optionEmpty");
    });

var binluuSimpleQuestion = new BinluuSimpleQuestion('sexQuestion',{
    optionSelector:".optionButton",
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
            $('tagContainer').insert({
                bottom: new Element('span',{id:$(tag).readAttribute('id'),class:"usedTag"}).update($(tag).innerHTML)
                    .insert({
                        bottom: new Element('input',{type:'hidden',value:$(tag).innerHTML,ele:"tag"})
                    })
                    .insert({
                        bottom: new Element('input',{type:'hidden',value:$(tag).id,'ele':"category_tag_id"})
                    })
            });
        }
        if($('tagContainer').select('input').length>0){
            var indxT=0;
            var indxC=0;
            $('tagContainer').select('input').each(function(input,indx){
                if(input.readAttribute('ele')=="tag"){
                    $(input).writeAttribute('id','PersonProfileCategoryTag'+indxT);
                    $(input).writeAttribute('name','data[PersonProfileTag]['+indxT+'][tag]');
                    indxT++;
                }
                else{
                    $(input).writeAttribute('id','PersonProfileCategoryTag'+indxC);
                    $(input).writeAttribute('name','data[PersonProfileTag]['+indxC+'][category_tag_id]');
                    indxC++;
                }
            });
            $('emptyIntereses').hide();
        }else{
             $('emptyIntereses').show();
        }
        
    }

});

</script>