<div class="ventas form">
<?php echo $this->Form->create('Venta'); ?>
	<fieldset>
		<legend><?php echo __('Add Venta'); ?></legend>
	<?php
		echo $this->Form->input('importe');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ventas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Numerosvendidos'), array('controller' => 'numerosvendidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Numerosvendido'), array('controller' => 'numerosvendidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
