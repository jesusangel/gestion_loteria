<div class="sorteos">
<?php echo $this->Form->create('Sorteo'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sorteo'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero', array('size' => 3, 'maxlength' => 3));
		echo $this->Form->input('anio', array('size' => 4, 'maxlength' => 4));
		echo $this->Form->input('precio_x_decimo', array('size' => 5, 'maxlength' => 5));
		echo $this->Form->input('fecha');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>