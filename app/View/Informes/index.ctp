<div class="informes form">
<?php echo $this->Form->create('Informe', array('action' => 'view')); ?>
	<fieldset>
		<legend><?php echo __('Rango de fechas'); ?></legend>
	<?php
			echo $this->Form->input("fecha_inicial", array('type' => 'date', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 5, 'maxYear' => date('Y') + 1));
			echo $this->Form->input("fecha_final", array('type' => 'date', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 5, 'maxYear' => date('Y') + 1));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Aceptar')); ?>
</div>