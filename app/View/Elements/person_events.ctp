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
<?php echo $this->Paginator->counter('Página {:page} de {:pages}');?>
<?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev disabled'));?>
<?php echo $this->Paginator->next(' > ', array(), null, array('class' => 'next disabled'));?>
<div class="events_container">
	<p class="title">Eventos a los que has sido invitado :)</p>
	<?php $no_event = 0; ?>
	<?php foreach ($events as $event): ?>
	<?php $images = $event['Event']['AdviserProperty']['PropertyImage']; ?>
	<div class="wrapper" style="<?php echo $no_event>0?$no_event===1?'top:-145px;':'top:-190px;':''; ?>">
		<div class="event_item">
			<div class="images">
				<?php $no_images = 0; ?>
				<div id="myshow<?php echo $no_event;?>" class="protoshow" style="height: 250px;"><!-- protoshow container -->
					<ul class="show"><!-- slideshow itself -->
					<?php foreach ($images as $image): ?>
						<?php if($no_images++ < 3){ ?>
							<li class="slide">
								<?php echo $this->Html->image('/files/'.$image['image'], array('alt' => 'test', 'width' => '275px', 'height' => '178px')); ?>
							</li>
						<?php }?>
					<?php endforeach; ?>
					</ul>
				</div>
		  </div>
		  <div class="black">
			  <div class="description">
			  	<div class="event_title">
			  		<label>Visita a departamento en <?php echo $event['Event']['AdviserProperty']['address']; ?></label>
			  	</div>
			  	<div class="detail">
			  		<label>Descripci&oacute;n:</label>
			  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
			  		<label>Direcci&oacute;n:</label>
			  		<?php echo $this->Html->para(null, $event['Event']['AdviserProperty']['address']); ?>
			  		<?php $date = new DateTime($event['Event']['date']); ?>
			  		<label class="datetime">Fecha:</label>
			  		<?php echo $this->Html->para('datetime', $date->format('d F Y')); ?>
			  		<label class="datetime">Hora:</label>
			  		<?php echo $this->Html->para('datetime', $date->format('H:i:s'), array('style'=>'float: none;')); ?>
			  		<label style="float: left; margin-right: 5px;">Invita:</label>
			  		<?php echo $this->Html->para(null, $event['Event']['Adviser']['User']['name'].' '.$event['Event']['Adviser']['User']['last_name']); ?>
			  	</div>
					<div class="invited_users">
						<label>Tambi&eacute;n fueron invitados:</label>
						<?php $guests = $event['Request']['Guests']; ?>
						<?php foreach ($guests as $guest): ?>
						<?php $image = $guest['Person']['User']['image']===null?$guest['Person']['PersonProfile']['sex']==='M'?'default_img_male.png':'default_img_female.png':$guest['Person']['User']['image']; ?>
						<?php echo $this->Html->link(
								$this->Html->image('/files/'.$image, array('alt'=>$guest['Person']['User']['name'], 'title'=>$guest['Person']['User']['name'], 'width'=>'48px')),
								array('controller'=>'Person', 'action'=>'view', $guest['Person']['id']),
								array('escape'=>false, 'class'=>'guest')); ?>
						<?php endforeach; ?>
					</div>
			  </div>
			</div>
		  <div class="request">
		  	<label class="block legend">Asistir:</label>
		  	<?php echo $this->Html->link('Sí', array('controller'=>'Request', 'action'=>'confirm', $event['Request']['id']), array('class'=>$event['Request']['status'] === 'A' ? 'block response accept' : 'block response')); ?>
		  	<?php echo $this->Html->link('No', array('controller'=>'Request', 'action'=>'cancel', $event['Request']['id']), array('class'=>$event['Request']['status'] === 'C' ? 'block response cancel' : 'block response')); ?>
		  </div>
		  <div class="img_back">
				<div class="left_img"></div>
				<div class="right_img"></div>
			</div>
			<div class="cintillo">
					<?php echo $this->Html->image('cintillo.png', array('alt' => '')); ?>
			</div>
		</div>
	</div>
	<br>
	<?php $no_event++; endforeach; ?>
</div>