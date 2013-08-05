<div class="decimosconsignados form">
<?php echo $this->Form->create('Decimosconsignado'); ?>
	<fieldset>
		<legend><?php echo __('Editar número consignado'); ?></legend>
	<?php
		echo $this->Form->input('sorteo_id');	
		echo $this->Form->input('id');
		echo $this->Form->input('numero');
		echo $this->Form->input('cantidad');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>