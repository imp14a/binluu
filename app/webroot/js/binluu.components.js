/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var BinluuSlider = Class.create();

BinluuSlider.prototype = {
    element:null,
    slider : null, // Scriptaculus slider
    inputs : null, // must be 2 inputs
    options : null,
    initialize:function(element,inputs,options){
        this.element = element;
        this.inputs = inputs;
        this.options = options;
        var that = this;
        this.slider = new Control.Slider($(element).select('.handle'), element, {
            range: $R(0, this.options.size), 
            increment: 1,
            sliderValue: [0, 8],
            onSlide: function(values) {
                valMin = (values.map(Math.round)[0] - this.range.start) / (this.range.end - this.range.start);
                valMin = $(that.element).getWidth() * valMin;
                valMax = (values.map(Math.round)[1] - this.range.start) / (this.range.end - this.range.start);
                valMax = $(that.element).getWidth() * valMax;
                
                for(i=0;i<that.inputs.length;i++){
                    switch(values.map(Math.round)[i]){
                        case this.range.start:
                            $(that.inputs[i]).value = that.options.minLabel;
                        break;
                        case this.range.end:
                            $(that.inputs[i]).value = that.options.maxLabel;
                        break;
                        default:
                            $(that.inputs[i]).value = that.getCurrencyValue(that.options.rangeValues[values.map(Math.round)[i]]);
                        break;
                    }
                }
            },
            restricted: true
        });
        this.slider.setValue(options.initMin,0);
        this.slider.setValue(options.initMax,1);
    },
    setRangeValues:function(newValue){
       this.options.rangeValues = newValue;
    },
    setConcurrency:function(newValue){
        this.options.concurrency = newValue;
    },
    resetSlider:function(){
        this.slider.setValue(0, 0);
        this.slider.setValue(9, 1);
    },
    getCurrencyValue:function(number){
        return this.options.concurrency.coinSimbol +" "+ number + this.options.concurrency.sufijo;
    }
};

var BinluuProcess = Class.create();

BinluuProcess.prototype = {
    step:null,
    classNextButton : "next",
    classNextBefore : "before",
    container:null,
    initialize:function(container,options){
        var that=this;
        this.container = container;
        $(container).select('.step').each(function(element){
            if($(element).readAttribute('id')!="1"){
                $(element).hide();
                that.step="1";
            }
        });
        $(container).select('.next').each(function(element){
            $(element).observe('click',function(){
                $(that.container).select("#"+that.step).each(function(st){$(st).hide();});
                that.step = $(element).readAttribute('step');
                $(that.container).select("#"+that.step).each(function(st){$(st).show();});
            });
        });

    }
};

var BinluuTagSelector = Class.create();

BinluuTagSelector.prototype = {
    container:null,
    options:null,
     initialize:function(container,options){
        this.container = container;
        this.options = options;
        $(container).hide();
        var that = this;
        $(options.actionButton).observe('click',function(){
            if($(that.container).hasClassName('active')){
                $(that.container).removeClassName('active');
                $(that.container).hide();
            }else{
                $(that.container).addClassName('active');
                $(that.container).show();
            }
            
        });

        $(container).select('.tag').each(function(element){
            $(element).observe('click',function(){
                var remove = false;
                if($(element).hasClassName('selected')){
                    $(element).removeClassName('selected');
                    remove = true;
                }else{
                    $(element).addClassName('selected');
                    remove = false;
                }
                that.options.tagChanged(element,remove);
            });
        });

     }

};

var BinluuSimpleQuestion = Class.create();

BinluuSimpleQuestion.prototype = {
    container:null,
    options:null,
    initialize:function(container,options){
        this.options = options;
        this.container = container;
        var that = this;
        $(container).select(this.options.optionSelector).each(function(opt){
            $(opt).observe('click',function(){
                $(that.container).select(that.options.optionSelector).each(function(o){
                    $(o).setStyle({
                        opacity: 0.5
                    });
                });
                $(opt).setStyle(
                    {
                        opacity: 1
                    }
                );
                that.options.changeOption($(opt).readAttribute('value'));
            });
        });
     }

};
