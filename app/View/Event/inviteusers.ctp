<?php echo $this->Html->css('binluu.components'); ?>
<?php echo $this->Html->css('binluu.register'); ?>
<?php echo $this->Html->css('adviser.events'); ?>
<?php echo $this->Html->script('binluu.components'); ?>
<?php $this->layout = 'adviser'; ?>
<div class="event_creation">
  <div class="back_img">
    <p class="desc_title">Encuentre perfiles acordes a su oferta</p>
    <?php echo $this->Form->create('EventProfile'); ?>
    <div class="left" style="width: 47%;padding-right: 5%;">
      <?php echo $this->Form->input('age', array('label'=>false, 'placeholder'=>'Edad', 'style'=>'width:35%;float:left;margin-right:30px;')); ?>
      <div class="input select">
        <?php $options = array('N'=>'Sexo','M' => 'Masculino', 'F' => 'Femenino'); 
        echo $this->Form->select('sex', $options,array("value"=>"N","class"=>"optionEmpty half",'empty'=>false,'style'=>'width:35%'));  ?>
      </div>
      <div class="input select">
      <?php echo $this->Form->select('transport', $transports,array("value"=>"N","class"=>"optionEmpty half",'empty'=>false,'style'=>'width:94% !important')); ?>
      </div>
      <div class="input select">
      <?php echo $this->Form->select('ocupation', $ocupations, array("value"=>"N","class"=>"optionEmpty half",'empty'=>false,'style'=>'width:94% !important')); ?>
      </div>
      <div class="slider_input" style="margin-left: 6.5%;margin-top: 30px;">
        <span class="legend">Presupuesto</span>
        <div class="slider_container">
          <div id="slider" class="slider">
              <div class="handle"></div>
              <div class="handle"></div>
              <div class="top" style="left: -3%;"></div>
              <div id="id_range" class="range"></div>
              <div class="top" style="left: 97%;"></div>
          </div>
        </div>
        <?php echo $this->Form->input('EventProfile.min_budget', array('label' => 'Desde','value'=>'$ 1,000.00','readonly',"class"=>"midle","type"=>"text")); ?>
        <?php echo $this->Form->input('EventProfile.max_budget', array('label' => 'Hasta','value'=>'$ 12,000.00','readonly',"class"=>"midle","type"=>"text")); ?>
      </div>
      <div class="action">
        <a id="search" class="search_users">Buscar ></a>
        <?php echo $this->Html->link('< Regresar', array('action'=>'create'), array('class'=>'cancel')); ?>
        <?php echo $this->Form->end(array('label'=>'Terminar', 'div'=>array('class'=>'end'))); ?>
      </div>
    </div>
    <div class="users">
      <a id="up" class="btn_flow"></a>
      <div id="wrapper" class="wrapper_list">
        <ul id="user_list" class="invite_list" style="margin-top: 0px;">
        </ul>
      </div>
      <a id="down" class="btn_flow"></a>
      <?php echo $this->Html->image('loading.gif', array('id'=>'img_loading', 'style'=>'position: relative;top: -213px;left: 48%;display:none;')); ?>
    </div>
  </div>
</div>
<script>
    
    $("EventProfileSex").observe('change',function () {
        if($(this).value == "N") $(this).addClassName("optionEmpty");
        else $(this).removeClassName("optionEmpty");
    });

    var slider = new BinluuSlider('slider',
                    [   'EventProfileMinBudget',
                        'EventProfileMaxBudget'
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

    $('down').observe('click', function(){
      if(parseInt($('user_list').getStyle('margin-top')) > (Math.ceil($$('li').length/2)-1)*-303){
        $('user_list').setStyle({
          'margin-top': (parseInt($('user_list').getStyle('margin-top')) - 303) + 'px'
        });
      }
    });

    $('up').observe('click', function(){
      if(parseInt($('user_list').getStyle('margin-top')) < 0){
        $('user_list').setStyle({
          'margin-top': (parseInt($('user_list').getStyle('margin-top')) + 303) + 'px'
        });
      }
    });

    function getUsers(){
      $('img_loading').setStyle({
        'display': 'block'
      });
      $('wrapper').addClassName('loading');
      var obj;
      new Ajax.Request('http://www.binluu.com.mx/Person/getPersonsByProfile.json', {
          method: 'get',
          parameters: {
            age:        $('EventProfileAge').value,
            sex:        $('EventProfileSex').value,
            transport:  $('EventProfileTransport').value,
            ocupation:  $('EventProfileOcupation').value,
            minBudget:  $('EventProfileMinBudget').value,
            maxBudget:  $('EventProfileMaxBudget').value

          },
          onSuccess: function(transport) {
            var response = transport.responseJSON || "no response text";
            obj = JSON.parse(response);
            $('user_list').update('');
            obj.each(function(person){
              var text = isPersonInvited(<?php echo $event_id; ?>, person.Person.id);
              var resultInvited = 'Invitar ' + (typeof text != 'undefined' ? text : '');
              var tags = '';
              person.PersonProfile.PersonProfileTag.each(function(tag){
                tags += tag.tag + ', ';
              });
              tags = tags.substring(0, tags.length-2);              
              var linkInvite = new Element('a', {
                class: resultInvited
              }).update(text).observe('click', function(){
                if(text!='Invitado'){
                  sendMail(<?php echo $event_id; ?>, person.Person.id);
                  this.update('Invitado');
                  this.addClassName('Invitado');
                }
              });
              linkInvite.update(text);
              $('user_list').insert(new Element('li').insert(new Element('div', {
                class: 'user_item'
              }).insert(new Element('img',{
                src:   '/app/webroot/files/' + (person.User.image!=null?person.User.image:person.PersonProfile.sex=='M'?'default_img_male.png':'default_img_female.png'),
                width: '55px',
                height:'55px'
              })).insert(new Element('label', {
                class: 'name'
              }).update(person.User.name))
              .insert(new Element('label').update(person.PersonProfile.age + ' años'))
              .insert(new Element('label').update(person.PersonProfile.ocupation))
              .insert(linkInvite).insert(new Element('div',{class: 'interest_tags'})
              .insert(new Element('label', {class: 'name'}).update('Intereses:'))
              .insert(new Element('label').update(tags)).insert(new Element('label', {class: 'name'}).update('Medio de transporte:')
                .setStyle({
                  float: 'left',
                  'margin-top': '-2px'
                }))
              .insert(new Element('label').update(person.PersonProfile.transport)
                .setStyle({
                  'display': 'inline-block',
                  'margin-left': '10px',
                  'position': 'relative',
                  'top': '-2px'
              })))));
            });
            $('img_loading').setStyle({
              'display': 'none'
            });
            $('wrapper').removeClassName('loading');
          },
          onFailure: function() {
            $('img_loading').setStyle({
              'display': 'none'
            });
            $('wrapper').removeClassName('loading');
          }
        }
      );
    }

    $('search').observe('click', getUsers);

    function isPersonInvited(event_id, person_id){
      var result;
      var request = new Ajax.Request('http://www.binluu.com.mx/Request/isPersonInvited.json', {
          method: 'get',
          asynchronous: false,
          parameters: {
            personID: person_id, 
            eventID:  event_id
          },
          onSuccess: function(transport) {
            var obj = transport.responseJSON;
            if(typeof obj !='undefined')
              result = obj.notified_by_mail ? 'Invitado' : 'Invitar';
            else
              result= 'Invitar';
          },
          onFailure: function(){
            result= 'Invitar';
          }
        });
      return result; 
    }

    function sendMail(event_id, person_id){
      var result;
      var request = new Ajax.Request('http://www.binluu.com.mx/Request/invitePerson.json', {
          method: 'get',
          asynchronous: false,
          parameters: {
            personID: person_id, 
            eventID:  event_id
          },
          onSuccess: function(transport) {
            var obj = transport.responseJSON;
            if(typeof obj!='undefined')
              result = obj;
            else
              result= false;
          },
          onFailure: function(){
            result= false;
          }
        });
      return result;
    }

    getUsers();
</script>