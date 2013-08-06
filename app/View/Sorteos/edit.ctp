<div class="sorteos form">
<?php echo $this->Form->create('Sorteo'); ?>
	<fieldset>
		<legend><?php echo __('Editar Sorteo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero', array('size' => 4));
		echo $this->Form->input('anio', array('label' => __('Año'), 'size' => 4));
		echo $this->Form->input('precio_x_decimo', array('size' => 5));
		echo $this->Form->input('fecha', array('dateFormat' => 'DMY'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>