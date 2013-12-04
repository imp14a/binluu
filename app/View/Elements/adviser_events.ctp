<?php echo $this->Html->css('adviser.events'); ?>
<?php echo $this->Html->css('protoshow'); ?>
<?php echo $this->Html->script('protoshow'); ?>
<?php $this->layout = 'adviser'; ?>   
<script type="text/javascript">
document.observe('dom:loaded', function() {
	<?php $no_images = 0; ?>
	<?php foreach ($events as $event): ?> 
	var show<?php echo $no_images;?> = $('myshow<?php echo $no_images;?>').protoShow(); 
	<?php $no_images++; endforeach; ?>
});
</script>
<?php if(count($events)===0){ ?>
<div class="no_events">
	<p style="
    font-family: StoneSansStd-MediumItalic;
    font-size: 14pt;
    color: #FFF;
    position: relative;
    top: 142px;">Sin eventos registrados, comience uno ahora</p>
</div>
<?php } else { ?>
	<br>
	<p class="list_title">Mis Eventos</p>
	<?php echo $this->Html->link('Nuevo evento', array('action'=>'create'), array('class'=>'new')); ?>
	<div class="paginator">
		<?php echo $this->Paginator->counter('Página {:page} de {:pages}');?>
		<?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev disabled'));?>
		<?php echo $this->Paginator->next(' > ', array(), null, array('class' => 'next disabled'));?>
	</div>
	<br>
	<div class="event_list" style="<?php echo count($events)>1?count($events)===2?'height:600px;':'height:901px':'height:306px'; ?>">
		<?php $no_event = 0; ?>
		<?php foreach ($events as $event): ?>
		<?php //var_dump($event['AdviserProperty']); ?>
		<?php $images = $event['AdviserProperty']['PropertyImage']; ?>
	<div class="wrapper" style="<?php echo $no_event>0?$no_event===1?'top:-65px;':'top:-128px;':''; ?>">
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
			  		<label>Visita a departamento en <?php echo $event['AdviserProperty']['address']; ?></label>
			  	</div>
			  	<div class="detail">
			  		<label>Descripci&oacute;n:</label>
			  		<?php echo $this->Html->para(null, $event['Event']['property_description']); ?>
			  		<label>Direcci&oacute;n:</label>
			  		<?php echo $this->Html->para(null, $event['AdviserProperty']['address']); ?>
			  		<?php $date = new DateTime($event['Event']['date']); ?>
			  		<label class="datetime img_date">Fecha:</label>
			  		<?php echo $this->Html->para('datetime', $date->format('d F Y')); ?>
			  		<label class="datetime img_time">Hora:</label>
			  		<?php echo $this->Html->para('datetime', $date->format('H:i:s'), array('style'=>'float: none;')); ?>
			  		<label style="float: left; margin-right: 5px;">Invita:</label>
			  		<?php echo $this->Html->para(null, $event['Adviser']['User']['name'].' '.$event['Adviser']['User']['last_name']); ?>
			  	</div>
			  </div>
			</div>
		  <div class="request">
		  	<label class="legend">fueron invitados:</label>
		  	<div class="invited_users">
					<?php $guests = $event['Request']['Guests']; ?>
					<?php foreach ($guests as $guest): ?>
					<?php $image = $guest['Person']['User']['image']===null?$guest['Person']['PersonProfile']['sex']==='M'?'default_img_male.png':'default_img_female.png':$guest['Person']['User']['image']; ?>
					<?php echo $this->Html->link(
							$this->Html->image('/files/'.$image, array('alt'=>$guest['Person']['User']['name'], 'title'=>$guest['Person']['User']['name'], 'width'=>'30px', 'height'=>'30px')),
							array('controller'=>'Person', 'action'=>'view', $guest['Person']['id']),
							array('escape'=>false, 'class'=>'guest')); ?>
					<?php echo $this->Html->link(
							$this->Html->image('/files/'.$image, array('alt'=>$guest['Person']['User']['name'], 'title'=>$guest['Person']['User']['name'], 'width'=>'30px', 'height'=>'30px')),
							array('controller'=>'Person', 'action'=>'view', $guest['Person']['id']),
							array('escape'=>false, 'class'=>'guest')); ?>
					<?php echo $this->Html->link(
						$this->Html->image('/files/'.$image, array('alt'=>$guest['Person']['User']['name'], 'title'=>$guest['Person']['User']['name'], 'width'=>'30px', 'height'=>'30px')),
					array('controller'=>'Person', 'action'=>'view', $guest['Person']['id']),
					array('escape'=>false, 'class'=>'guest')); ?>
					<?php echo $this->Html->link(
							$this->Html->image('/files/'.$image, array('alt'=>$guest['Person']['User']['name'], 'title'=>$guest['Person']['User']['name'], 'width'=>'30px', 'height'=>'30px')),
							array('controller'=>'Person', 'action'=>'view', $guest['Person']['id']),
							array('escape'=>false, 'class'=>'guest')); ?>
					<?php endforeach; ?>
				</div>
				<div class="response">
					<?php echo $this->Html->link('Editar evento', array('action'=>'edit', $event['Event']['id']), array('class'=>'block')); ?>
					<?php echo $this->Form->postLink('Cancelar evento', array('action'=>'cancel', $event['Event']['id']), array('class'=>'block'), '¿Está seguro que quiere borrar este evento?'); ?>
				</div>
		  </div>
			<div class="cintillo">
					<?php echo $this->Html->image('Linea-de-circulos.png', array('alt' => '')); ?>
			</div>
		</div>
	</div>
	<br>
		<?php $no_event++; endforeach; ?>
	</div>
<?php } ?>