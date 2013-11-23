<?php echo $this->Html->css('person.events'); ?>
<?php echo $this->Html->css('protoshow'); ?>
<?php echo $this->Html->script('protoshow'); ?>
<script type="text/javascript">
document.observe('dom:loaded', function() {
	<?php $no_images = 0; ?>
	<?php foreach ($events as $event): ?> 
	var show<?php echo $no_images;?> = $('myshow<?php echo $no_images;?>').protoShow(); 
	<?php $no_images++; endforeach; ?>
});
</script>
<div class="events_container">
	<p class="title">Eventos a los que has sido invitado :)</p>
	<?php $no_event = 0; ?>
	<?php foreach ($events as $event): ?>
	<?php $images = $event['Event']['Adviser']['AdviserProperty']['0']['PropertyImage']; ?>
	<div class="event_item">
		<div class="images">
			<?php $no_images = 0; ?>
			<div id="myshow<?php echo $no_event;?>" class="protoshow" style="height: 250px;"><!-- protoshow container -->
				<ul class="show"><!-- slideshow itself -->
				<?php foreach ($images as $image): ?>
					<?php if($no_images++ < 3){ ?>
						<li class="slide">
							<?php echo $this->Html->image('/files/'.$image['image'], array('alt' => 'test', 'width' => '270px')); ?>
						</li>
					<?php }?>
				<?php endforeach; ?>
				</ul>
			</div>
	  </div>
	  <div class="description">
	  	<div class="event_title">
	  		<label>Visita a departamento en <?php echo $event['Event']['address']; ?></label>
	  	</div>
	  	<div class="detail">
	  		<label>Descripci&oacute;n:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
	  		<label>Direcci&oacute;n:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['address']); ?>
	  		<label class="datetime">Fecha:</label>
	  		<?php echo $this->Html->para('datetime', $event['Event']['date']); ?>
	  		<label class="datetime">Hora:</label>
	  		<?php echo $this->Html->para('datetime', $event['Event']['property_description']); ?>
	  		<label>Invita:</label>
	  		<?php echo $this->Html->para(null, $event['Event']['Adviser']['User']['name'].' '.$event['Event']['Adviser']['User']['last_name']); ?>
	  	</div>
			<div class="invited_users">
				<label>Tambi&eacute;n fueron invitados:</label>
				<?php //var_dump($event); ?>
				<?php //foreach ($guests as $guest): ?>
				<?php //echo $this->Html->image(''); ?>
				<?php //endforeach; ?>
			</div>
	  </div>
	  <div class="request">
	  	<label class="block legend">Asistir:</label>
	  	<?php echo $this->Html->link('Sí', array('controller'=>'Request', 'action'=>'confirm', $event['Request']['id']), array('class'=>$event['Request']['status'] === 'A' ? 'block response accept' : 'block response')); ?>
	  	<?php echo $this->Html->link('No', array('controller'=>'Request', 'action'=>'cancel', $event['Request']['id']), array('class'=>$event['Request']['status'] === 'C' ? 'block response cancel' : 'block response')); ?>
	  </div>
	</div>
	<div class="cintillo">
			<?php echo $this->Html->image('cake_logo.png', array('alt' => 'CakePHP')); ?>
	</div>
	<?php $no_event++; endforeach; ?>
</div>
