<?php echo $this->Html->css('binluu.components'); ?>
<?php echo $this->Html->css('adviser.events'); ?>
<div class="event_creation">
    <div class="back_img">
	    <p class="desc_title">Intoduzca los datos y escoja una ubicaci&oacute;n</p>
	    <?php echo $this->Form->create('Event', array('type'=>'file')); ?>
	    <div class="left">
		    <?php echo $this->Form->input('Event.name', array('label'=>false, 'placeholder'=>'Nombre del evento', 'style'=>'min-width:300px; display:block;width: 100%;')); ?>
		    <?php echo $this->Form->input('AdviserProperty.address', array('label'=>false, 'placeholder'=>'Dirección', 'style'=>'min-width:300px; display:block;width: 100%;')); ?>
		    <?php echo $this->Form->input('Event.date', array('label'=>false, 'placeholder'=>'Fecha', 'style'=>'width:100px')); ?>
	    </div>
	    <div class="right">
		    <?php echo $this->Form->textarea('Event.property_description', array('label'=>false,'rows'=>'9', 'placeholder'=>'Descripción del inmueble', 'style'=>'width:100%; height: 150px;')); ?>
	    </div>
	    <div class="details">
		    <div id="map">
		    </div>
		    <div class="images_files">
			    <p>Suba dos fotos del lugar</p>	
			    <div class="img_box">			    
			        <?php echo $this->Form->input('PropertyImage.0.image', array('label'=>false , 'type'=>'file', 'style'=>'opacity:0;')); ?>
			        <?php echo $this->Form->input('PropertyImage.0.type', array('type'=>'hidden', 'value'=>'description')); ?>
			    </div>
			    <div class="img_box">
			        <?php echo $this->Form->input('PropertyImage.1.image', array('label'=>false, 'type'=>'file', 'style'=>'opacity:0;')); ?>
			        <?php echo $this->Form->input('PropertyImage.1.type', array('type'=>'hidden', 'value'=>'description')); ?>
			    </div>		
		    </div>
	    </div>
	    <div class="action">
			    <?php echo $this->Html->link('Cancelar', array('action'=>'index'), array('class'=>'cancel')); ?>
			    <?php echo $this->Form->end("Siguiente >"); ?>
	    </div>
	</div>
</div>