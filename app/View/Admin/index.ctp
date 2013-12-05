<style>
    .welcomeMessage{
        text-align: center;
        font-size: 54px;
        color: #444;
        margin-top: 30px;
        clear: left;
    }
    .menu{
        margin-top: 30px;
        width: 100%;
        text-align: center;
    }
    .menu ul{
        
        display: inline-block;
    }
    .menu ul li{
        display: inline-block;
    }
    .menu li a{
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
        padding-right: 15px
    }
</style>
<div>
    <div class="menu">
        <ul >
            <li><?php echo $this->Html->link('Agregar Promotor',array('controller'=>'Adviser','action'=>'register'));?></li>
            <li><?php echo $this->Html->link('Asignar creditos',array('controller'=>'Account','action'=>'assign'));?></li>
            <li><?php echo $this->Html->link('Listar promotores',array('controller'=>'Adviser','action'=>'listAll'));?></li>
            <li><?php echo $this->Html->link('Listar usuarios',array('controller'=>'Person','action'=>'listAll'));?></li>
            <li><?php echo $this->Html->link('Usuarios en mapa',array('controller'=>'Adviser','action'=>'usersMap'));?></li>
            <li><?php echo $this->Html->link('Consumo de créditos',array('controller'=>'Account','action'=>'creditsReport'));?></li>
            <li><?php echo $this->Html->link('Eventos Concretados',array('controller'=>'Event','action'=>'eventsCompleted'));?></li>
        </ul>
    </div>
    <div class="welcomeMessage">
        Bienvenido Administrador!!
    </div>

</div>