<div class="decimosconsignados form">
<?php echo $this->Form->create('Decimosconsignado'); ?>
	<fieldset>
		<legend><?php echo __('Consignar décimos'); ?></legend>
	<?php
		echo $this->Form->input('numero');
		echo $this->Form->input('cantidad');
		echo $this->Form->input('sorteo_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>