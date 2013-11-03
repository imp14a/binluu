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
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['User']['name']; ?></td>
            <td><?php echo $user['User']['username']; ?></td>
            <td><?php echo $user['Adviser']['company']; ?></td>
            <td><?php echo $user['Adviser']['web']; ?></td>
            <td><?php echo $user['User']['phone']; ?></td>
            <td><?php echo $user['User']['last_login']; ?></td>
            <td><?php echo $this->Html->link('ver', array('controller' => 'User', 'action' => 'view', $user['Adviser']['id'])); ?>
        </tr>
        <?php endforeach; ?>
        <?php echo $this->Html->link('REGRESAR', array('controller' => 'Admin', 'action'=>'panelAdministration')); ?>
    </table>
</div>