<?php echo $this->Html->css('adviser.events'); ?>
<?php if(count($events)===1){ ?>
<div class="no_events">
	<p style="
    font-family: StoneSansStd-MediumItalic;
    font-size: 14pt;
    color: #FFF;
    position: relative;
    top: 142px;">Sin eventos registrados, comience uno ahora</p>
</div>
<?php } else { ?>
nada
<?php } ?>