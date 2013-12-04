<?php echo $this->Html->css('person.events'); ?>
<?php echo $this->Html->css('protoshow'); ?>
<?php echo $this->Html->script('protoshow'); ?>
<?php $this->layout = 'person'; ?>   
<script type="text/javascript">
document.observe('dom:loaded', function() {
	<?php $no_images = 0; ?>
	<?php foreach ($events as $event): ?> 
	var show<?php echo $no_images;?> = $('myshow<?php echo $no_images;?>').protoShow(); 
	<?php $no_images++; endforeach; ?>
});
</script>
<?php if(count($events)===0){ ?>
<div class="no_requests"></div>
<?php } else { ?>
<div class="events_container" style="<?php echo count($events)>1?count($events)===2?'height:580px;':'height:835px':'height:320px'; ?>">
	<p class="title">Eventos a los que has sido invitado :)</p>
	<div class="paginator">
		<?php echo $this->Paginator->counter('Página {:page} de {:pages}');?>
		<?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev disabled'));?>
		<?php echo $this->Paginator->next(' > ', array(), null, array('class' => 'next disabled'));?>
	</div>
	<?php $no_event = 0; ?>
	<?php foreach ($events as $event): ?>
	<?php $images = $event['Event']['AdviserProperty']['PropertyImage']; ?>
	<div class="wrapper" style="<?php echo $no_event>0?$no_event===1?'top:-145px;':'top:-290px;':''; ?>">
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
			  		<label class="datetime img_date">Fecha:</label>
			  		<?php echo $this->Html->para('datetime', $date->format('d F Y')); ?>
			  		<label class="datetime img_time">Hora:</label>
			  		<?php echo $this->Html->para('datetime', $date->format('H:i:s'), array('style'=>'float: none;')); ?>
			  		<label style="float: left; margin-right: 5px;">Invita:</label>
			  		<?php echo $this->Html->para(null, $event['Event']['Adviser']['User']['name'].' '.$event['Event']['Adviser']['User']['last_name']); ?>
			  	</div>
					<div id="view_guest" class="invited_users">
						<label>Tambi&eacute;n fueron invitados:</label>
						<?php $guests = $event['Request']['Guests']; ?>
						<?php foreach ($guests as $guest): ?>
						<?php $image = $guest['Person']['User']['image']===null?$guest['Person']['PersonProfile']['sex']==='M'?'default_img_male.png':'default_img_female.png':$guest['Person']['User']['image']; ?>
						<?php $id = $guest['Person']['id']; echo '<a id="guest'.$id.'" class="guest">'.
								$this->Html->image('/files/'.$image, array('alt'=>$guest['Person']['User']['name'], 'title'=>$guest['Person']['User']['name'], 'width'=>'24px', 'height'=>'24px')).'</a>'; ?>
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
<?php } ?>
<script type="text/javascript">
<?php foreach ($guests as $guest): ?>
<?php $id = $guest['Person']['id']; ?>
<?php echo "$('guest".$id."').observe('click', viewProfile)"; ?>
<?php endforeach; ?>

var guests = <?php echo json_encode($guests); ?>;


function viewProfile(event){
	var idPerson = event.target.offsetParent.id.replace('guest','');
	guests.each(function(guest){
		if(guest.Person.id = idPerson){
			var interests = '';
			for (var i = 0; i < guest.Person.PersonProfile.PersonProfileTag.length; i++) {
				interests += ' ' + guest.Person.PersonProfile.PersonProfileTag[i].tag;
			}
			var profile_view = new Element('div',{
				class: 'popup_profile'
			})
			.insert(new Element('img',{
				class: 'img_user',
				src:   '/app/webroot/files/' + guest.Person.User.image,
				width: '60px',
				height:'60px'	
			}))
			.insert(new Element('a',{
				id: 'close'
			}).observe('click', function(){
				profile_view.remove();
			}))
			.insert(new Element('p',{
				class: 'name'
			}).update(guest.Person.User.name + ' ' + guest.Person.User.last_name))
			.insert(new Element('p').update('Ocupación'))
			.insert(new Element('p',{
				class: 'desc'
			}).update(guest.Person.PersonProfile.ocupation))
			.insert(new Element('p').update('Intereses'))
			.insert(new Element('p',{
				class: 'desc'
			}).update(interests));
			$('view_guest').insert(profile_view);
		}
	});
}
</script>