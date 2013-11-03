<div>
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
	<br>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Compa&ntilde;ia</th>
            <th>Web</th>
            <th>Tel&eacute;fono</th>
            <th>&Uacute;ltimo Login</th>
            <th>Ver Perfil</th>
            <th>Activar/Desactivar</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['User']['name']; ?></td>
            <td><?php echo $user['User']['username']; ?></td>
            <td><?php echo $user['Adviser']['company']; ?></td>
            <td><?php echo $user['Adviser']['web']; ?></td>
            <td><?php echo $user['User']['phone']; ?></td>
            <td><?php echo $user['User']['last_login']; ?></td>
            <td><?php echo $this->Html->link('ver', array('controller' => 'Adviser', 'action' => 'edit', $user['Adviser']['id'])); ?>
            <td>
                <?php 
                    $active = $user['User']['active'] ? 'desactivar' : 'activar';
                    echo $this->Form->postLink(
                    $active,
                    array('controller'=>'User', 'action' => 'activate', $user['User']['id']),
                    array('confirm' => 'Desea '.$active.' el usuario?'));
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php echo $this->Html->link('REGRESAR', array('controller' => 'Admin', 'action'=>'panelAdministration')); ?>
        |
        <?php echo $this->Html->link('PROMOTORES ACTIVOS', array('controller'=>'Admin', 'action'=>'adviserlist', 1)); ?>
        |
        <?php echo $this->Html->link('PROMOTORES DESACTIVOS', array('controller'=>'Admin', 'action'=>'adviserlist', 0)); ?>
    </table>
</div>