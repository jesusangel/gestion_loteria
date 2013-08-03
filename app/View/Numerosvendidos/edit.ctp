<div class="numerosvendidos form">
<?php echo $this->Form->create('Numerosvendido'); ?>
	<fieldset>
		<legend><?php echo __('Edit Numerosvendido'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
		echo $this->Form->input('sorteo_id');
		echo $this->Form->input('cantidad');
		echo $this->Form->input('venta_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Numerosvendido.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Numerosvendido.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Numerosvendidos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ventas'), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta'), array('controller' => 'ventas', 'action' => 'add')); ?> </li>
	</ul>
</div>