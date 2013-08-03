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
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Sorteo.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Sorteo.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Decimosconsignados'), array('controller' => 'decimosconsignados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Decimosconsignado'), array('controller' => 'decimosconsignados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Numerosvendidos'), array('controller' => 'numerosvendidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Numerosvendido'), array('controller' => 'numerosvendidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
