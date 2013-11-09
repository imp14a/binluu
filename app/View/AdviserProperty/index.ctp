<div>
    <h1>Listado de propiedades</h3>
    <?php if($this->Session->check('Message')){ echo $this->Session->flash();} ?>  
    <br>
    <table>
        <tr>
            <th>Promotor</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        <?php foreach ($properties as $property): ?>
        <tr>
            <td><?php echo $property['AdviserProperty']['description']; ?></td>
            <td><?php echo $this->Html->link('editar', array('controller' => 'AdviserProperty', 'action' => 'edit', $property['AdviserProperty']['id'])); ?>
            <td>
                <?php echo $this->Form->postLink(
                    'borrar',
                    array('action' => 'delete', $property['AdviserProperty']['id']),
                    array('confirm' => 'Desea eliminar la propiedad?'));
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php echo $this->Html->link('AGREGAR PROPIEDAD', array('action'=>'add'));?>
        |
        <?php echo $this->Html->link('REGRESAR', array('controller'=>'Adviser','action'=>'index'));?>
    </table>
</div>