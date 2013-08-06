<div class="numerosinvendidos form">
<?php echo $this->Form->create('Numerosinvendido'); ?>
	<fieldset>
		<legend><?php echo __('Edit Numerosinvendido'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
		echo $this->Form->input('sorteo_id');
		echo $this->Form->input('cantidad');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $this->Form->value('Numerosinvendido.id')), null, __('¿Seguro que desea borrar # %s\?', $this->Form->value('Numerosinvendido.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Numerosinvendidos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
	</ul>
</div>
