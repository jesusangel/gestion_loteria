<div class="decimosconsignados form">
<?php echo $this->Form->create('Decimosconsignado'); ?>
	<fieldset>
		<legend><?php echo __('Edit Decimosconsignado'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
		echo $this->Form->input('serie');
		echo $this->Form->input('fraccion');
		echo $this->Form->input('sorteo_id');
		echo $this->Form->input('fecha_invendido');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Decimosconsignado.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Decimosconsignado.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Decimosconsignados'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
	</ul>
</div>
