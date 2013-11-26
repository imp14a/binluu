<?php 

    echo $this->Html->css('binluu.components');
    echo $this->Html->css('binluu.default');
    echo $this->Html->css('binluu.register');
    echo $this->Html->script('binluu.components');
  
?>
<?php 

    if($step==1){
        echo $this->element("Person/register_step_one");
    }elseif($step==2){
        echo $this->element("Person/register_step_two");
    }

?>
<script>
 /*   
    $("PersonProfileSex").observe('change',function () {
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
var stepProcess = new BinluuProcess('stepProces',[
        {
            step:1,
            beforeNext:function(stepContainer){
                //procedemos a validar
                var valid=true;
                $(stepContainer).select('[required=required]').each(function(inp){
                    console.log("entre a ver jejeje");
                    if($(inp).value.empty()){
                        console.log("esta vacia");
                        $(inp).addClassName('errorRequired');
                        valid = false;
                    }else{
                        $(inp).removeClassName('errorRequired');
                    }
                });
                return valid;
            }
        }
    ]
);

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

});*/

</script>