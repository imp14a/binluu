<?php $isPerson = $this->Session->read('Auth.User.rol') === 'Person';?>
<div>
    <h3>Mis Eventos</h3>
    <br>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripci&oacute;n</th>
            <th>Fecha</th>
            <th>Ver</th>
            <?php if(!$isPerson){?>
            <th>Cancelar</th>
            <?php }?>
        </tr>
        <?php foreach ($events as $event): ?>
        <tr>
            <td><?php echo $event['Event']['name']; ?></td>
            <td><?php echo $event['Event']['property_description']; ?></td>
            <td><?php echo $event['Event']['date']; ?></td>
            <td><?php echo $this->Html->link('ver', array('controller' => $isPerson?'Request':'Event', 'action' => 'view', $isPerson?$event['Request']['id']:$event['Event']['id'])); ?>
            <td>
                <?php if(!$isPerson){
                    echo $this->Form->postLink(
                    'cancelar',
                    array('controller'=>'Event', 'action' => 'cancel', $event['Event']['id']),
                    array('confirm' => 'Desea cancelar el evento?'));
                }
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php echo $this->Html->link('REGRESAR', array('controller' => $isPerson?'Person':'Adviser', 'action' => $isPerson?'home':'index')); ?>
        |
        <?php echo $this->Paginator->counter('Página {:page} de {:pages}');?>
        <?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev disabled'));?>
        <?php echo $this->Paginator->next(' > ', array(), null, array('class' => 'next disabled'));?>
    </table>
</div>