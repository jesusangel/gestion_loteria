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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('ui-lightness/jquery-ui-1.10.3.custom');
		echo $this->Html->css('keyboard');
		
		echo $this->Html->script('jquery-2.0.3'); // Include jQuery library
		echo $this->Html->script('jquery-ui-1.10.3.custom'); // Include jQuery library
		echo $this->Html->script('jquery.keyboard');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo __('Gestión de lotería nacional'); ?></h1>
		</div>
		<div id="menu">
			<ul>
				<li><?php echo $this->Html->link(__('Consignar'), array('controller' => 'decimosconsignados', 'action' => 'seleccionar_sorteo')); ?>
				<li><?php echo $this->Html->link(__('Vender'), array('controller' => 'ventas', 'action' => 'add')); ?>
				<li><?php echo $this->Html->link(__('Invender'), array('controller' => 'numerosinvendidos', 'action' => 'seleccionar_sorteo')); ?>
				<li><?php echo $this->Html->link(__('Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?>
				<li><?php echo $this->Html->link(__('Informes'), array('controller' => 'informes', 'action' => 'index')); ?>
				<?php if (Configure::read('debug')): ?>
				<li><?php echo $this->Html->link(__('Información'), array('controller' => 'pages', 'action' => 'info')); ?>
				<?php endif; ?>
				<li><?php echo $this->Html->link(__('Ayuda'), array('controller' => 'pages', 'action' => 'ayuda')); ?>
			</ul>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php		
		$this->Js->buffer("
			$('input:not(\'.focus\')').keyboard({
				layout : 'custom',
				customLayout : {
					'default' : [
						'7 8 9 {b}',
						'4 5 6 {clear}',
						'1 2 3  {clear}',
						'0 , {a} {c}'
					]
				}
			});
    	");
		$this->Js->buffer('$(".focus").focus()'); 
		echo $this->Js->writeBuffer(); // Write cached scripts 
	?>
</body>
</html>
