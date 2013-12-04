
<?php echo $this->Html->css('binluu.document');?>
<style>
    p{
        margin-top: 0px;
        margin-left: 32px;
        text-align: justify;
    }
    .informatioContaner{
        background-image: url(/img/faq_background.png);
        background-size: 30%;
        background-repeat: no-repeat;
        background-position: center right;
    }
    strong{
        background-image: url(/img/dot.png);
        background-size: contain;
        background-repeat: no-repeat;
        padding-left: 32px;
    }
</style>

<div class="informatioContaner">
	<!--<h3 class="title">Preguntas frecuentes</h3>-->
        <?php echo $this->Html->link($this->Html->div('close_document','') ,array('controller' => 'User', 'action' => 'home'), array('escape'=>false)); ?>
	<div style="margin-top:50px;">

		<strong>&iquest;Qu&eacute; es binluu&quest;</strong><br />
		<p>Es una plataforma que brinda conexión entre quienes  buscan compartir un departamento y el sector inmobiliario.</p>
		<strong>&iquest;Para qui&eacute;n es binluu&quest;</strong><br />
		<p>Para todas aquellas personas que buscan compartir un departamento en una zona especifica de forma segura y flexible.</p>
		<strong>&iquest;Puede cualquier persona ofrecer un cuarto o departamento compartido en renta en binluu&quest;</strong><br />
		<p>No, en binluu trabajamos con empresas inmobiliarias por una sencilla razón, nadie esta mas interesado en que consigas departamento como ellas, por eso nuestro compromiso es que recibas tantas ofertas como puedas y que estas sean de calidad.</p>
		<strong>&iquest;Por qu&eacute; binluu es seguro&quest;</strong><br />
		<p>Todos los departamentos a los que te invitamos son por parte de una inmobiliaria, y a tus posibles compañeros de renta los conoces antes de rentar, así que todos rentan desde cero y puedes rentar por tres meses para probar.</p>
		<strong>&iquest;Como hacer para no seguir recibiendo invitaciones&quest;</strong><br />
		<p>Desde los correos que te enviamos existe esta opción.</p>
		<strong style="display: inline-block; margin-bottom: 30px;">&iquest;Tienes otra duda&quest;</strong>
		<p style="display: inline;">Escríbenos a <a href="mailto:contact@binluu.com.mx">contact@binluu.com.mx</a></p>
	</div>

</div>