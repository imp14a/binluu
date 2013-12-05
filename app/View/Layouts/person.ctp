<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Binluu');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('binluu.default');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->Html->script('prototype');
    echo $this->Html->script('scriptaculous/scriptaculous');
    echo $this->Html->css('person.layout');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->Html->link($this->Html->div('logo','') ,array('controller' => 'User', 'action' => 'home'), array('escape'=>false)); ?>
			<span id="slogan">Descubre el departamento ideal para compartir.</span>
			<div class="user_logged">
				<div class="name_profile">
					<?php echo $this->Html->para('welcome', '¡Hola, '.$this->Session->read('Auth.User.name').'!'); ?>
					<?php echo $this->Html->link('Editar perfil', array('controller'=>'Person', 'action'=>'edit'), array('class'=>'edit_profile')); ?>
				</div>
			<?php $image = $this->Session->read('Auth.User.image')===null?$this->Session->read('Auth.User.sex')==='M'?'default_img_male.png':'default_img_female.png':$this->Session->read('Auth.User.image'); ?>
			<?php $image = '/files/'.$image; ?>
			<div class="image_profile">
			<?php echo $this->Html->image($image,array('title'=>$this->Session->read('Auth.User.name'), 'width'=>'45px', 'height'=>'46px')); ?>
			</div>
			<?php echo $this->Html->link('Cerrar sesion', array('controller'=>'User', 'action'=>'logout'), array('class'=>'logout_profile')); ?>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<span>binluu&reg; 2013</span>
                        <?php echo $this->Html->link($this->Html->div('faq','Preguntas frecuentes') ,array('controller' => 'User', 'action' => 'faq'), array('escape'=>false)); ?>
			<?php echo $this->Html->link($this->Html->div('contact','Contacto') ,array('controller' => 'User', 'action' => 'home'), array('escape'=>false)); ?>
			<?php echo $this->Html->link($this->Html->div('adviser','Soy asesor inmobiliario',array('style'=>'float:right; color: #FF6400;')) ,array('controller' => 'Adviser', 'action' => 'contact'), array('escape'=>false)); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
