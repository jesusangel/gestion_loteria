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