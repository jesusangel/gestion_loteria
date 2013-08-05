<div class="sorteos form">
<?php echo $this->Form->create('Sorteo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sorteo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
		echo $this->Form->input('anio');
		echo $this->Form->input('precio_x_decimo');
		echo $this->Form->input('fecha');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $this->Form->value('Sorteo.id')), null, __('¿Seguro que desea borrar # %s\?', $this->Form->value('Sorteo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Decimosconsignados'), array('controller' => 'decimosconsignados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Decimosconsignado'), array('controller' => 'decimosconsignados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Numerosvendidos'), array('controller' => 'numerosvendidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Numerosvendido'), array('controller' => 'numerosvendidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
