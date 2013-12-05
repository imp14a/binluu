<style>
    .backButton{
        margin-top: 15px;
        text-decoration: none;
        height: 24px;
        display: block;
        background: #fcee3a; /* Old browsers */
        background: -moz-linear-gradient(top, #fcee3a 0%, #fef8b0 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fcee3a), color-stop(100%,#fef8b0)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* IE10+ */
        background: linear-gradient(to bottom, #fcee3a 0%,#fef8b0 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcee3a', endColorstr='#fef8b0',GradientType=0 ); /* IE6-9 */
        color: #444;
        padding: 5px;
        line-height: 28px;
        padding-left: 15px;
        padding-right: 15px;
        border:none;
        width: 80px;
    }
    .report{
        text-align: center;
    }
    .report table{
        display: inline-block;
        margin-top: 20px;
    }
    .report table tr th{
        background: #fcee3a; /* Old browsers */
        background: -moz-linear-gradient(top, #fcee3a 0%, #fef8b0 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fcee3a), color-stop(100%,#fef8b0)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #fcee3a 0%,#fef8b0 100%); /* IE10+ */
        background: linear-gradient(to bottom, #fcee3a 0%,#fef8b0 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcee3a', endColorstr='#fef8b0',GradientType=0 ); /* IE6-9 */
        height: 28px;
        padding: 3px;
    }
    .report table tr td{
        padding: 3px;
    }
    
</style>
<?php echo $this->Html->link("< Regresar",array('controller'=>"User",'action'=>"login"),array('class'=>'backButton'));?>
<div class="report">
	<?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>
	<div class="paginator">
            <?php echo $this->Html->link('PROMOTORES ACTIVOS', array('controller'=>'Adviser', 'action'=>'listAll', 1)); ?>
            |
            <?php echo $this->Html->link('PROMOTORES DESACTIVOS', array('controller'=>'Adviser', 'action'=>'listAll', 0)); ?>
            |
            <?php echo $this->Html->link('TODOS', array('controller'=>'Adviser', 'action'=>'listAll')); ?>
            |
            <?php echo $this->Paginator->counter('Página {:page} de {:pages}');?>
            <?php echo $this->Paginator->prev(' < ', array(), null, array('class' => 'prev disabled'));?>
            <?php echo $this->Paginator->next(' > ', array(), null, array('class' => 'next disabled'));?>
        </div>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Compa&ntilde;ia</th>
            <th>Web</th>
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
    </table>
</div>