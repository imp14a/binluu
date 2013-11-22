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
            range: $R(0, 8), 
            increment: 1,
            sliderValue: [0, 8],
            onSlide: function(values) {
                valMin = (values.map(Math.round)[0] - this.range.start) / (this.range.end - this.range.start);
                valMin = $(that.element).getWidth() * valMin;
                valMax = (values.map(Math.round)[1] - this.range.start) / (this.range.end - this.range.start);
                valMax = $(that.element).getWidth() * valMax;
                
                id_range.setStyle({
                    'margin-left': valMin + 'px',
                    'width': (valMax - valMin) + 'px'
                });

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