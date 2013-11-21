<div>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
	<br>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Ocupaci&oacute;n</th>
            <th>Edad</th>
            <th>Sexo</th>
            <th>Intereses</th>
            <th>&Uacute;ltimo Login</th>
            <th>Ver Perfil</th>
            <th>Activar/Desactivar</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['User']['name']; ?></td>
            <td><?php echo $user['User']['username']; ?></td>
            <td><?php echo $user['PersonProfile']['ocupation']; ?></td>
            <td><?php echo $user['PersonProfile']['age']; ?></td>
            <td><?php echo $user['PersonProfile']['sex']; ?></td>
            <td><?php echo $user['PersonProfile']['interests']; ?></td>
            <td><?php echo $user['User']['last_login']; ?></td>
            <td><?php echo $this->Html->link('ver', array('controller' => 'Person', 'action' => 'edit', $user['PersonProfile']['person_id'])); ?>
           <td>
                <?php 
                    $active = $user['User']['active'] ? 'desactivar' : 'activar';
                    echo $this->Form->postLink(
                    $active,
                    array('controller'=>'User', 'action' => 'activate', $user['User']['id']),
                    array('confirm' => 'Desea '.$active.' el usuario?'));
                ?>
            </td>
        <?php endforeach; ?>
        <?php echo $this->Html->link('REGRESAR', array('controller' => 'Admin', 'action'=>'index')); ?>
        |
        <?php echo $this->Html->link('USUARIOS ACTIVOS', array('controller'=>'Person', 'action'=>'listAll', 1)); ?>
        |
        <?php echo $this->Html->link('USUARIOS DESACTIVOS', array('controller'=>'Person', 'action'=>'listAll', 0)); ?>
        |
        <?php echo $this->Html->link('TODOS', array('controller'=>'Person', 'action'=>'listAll')); ?>
        |
        <?php echo $this->Paginator->counter('Página {:page} de {:pages}');?>
        <?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev disabled'));?>
        <?php echo $this->Paginator->next(' > ', array(), null, array('class' => 'next disabled'));?>
    </table>
</div>