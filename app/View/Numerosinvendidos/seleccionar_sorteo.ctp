<div class="numerosinvendidos form">
<?php echo $this->Form->create('Numerosinvendido'); ?>
	<fieldset>
		<legend><?php echo __('Seleccione el sorteo para invender'); ?></legend>
	<?php
		echo $this->Form->input('sorteo_id', array(
			'empty' => __('Seleccione un sorteo de la lista o "escanee" un décimo')
		));		
		echo $this->Form->input('codigo', array(
			'label' => __('Código del décimo'),
			'maxlength' => 20,
			'size' => 20,
			'class' => 'focus'
		));
	?>
	</fieldset>	
<?php echo $this->Form->end(); ?>

<?php if ( $this->request->data('Sorteo') ) : ?>
<div class="sorteos">
<?php 
	echo $this->Form->create('Sorteo', array('url' => array('controller' => 'numerosinvendidos', 'action' => 'invender')));
?>
	<fieldset>
		<legend><?php echo __('Sorteo seleccionado'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero', array('size' => 3, 'maxlength' => 3, 'readonly' => true));
		echo $this->Form->input('anio', array('size' => 4, 'maxlength' => 4, 'readonly' => true));
		echo $this->Form->input('precio_x_decimo', array('value' => 0 + $this->request->data['Sorteo']['precio_x_decimo'], 'size' => 5, 'maxlength' => 5, 'readonly' => true));
		echo $this->Form->input('fecha', array('dateFormat' => 'DMY', 'minYear' => date('Y'), 'maxYear' => date('Y') + 1, 'readonly' => true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Invender números')); ?>
</div>
<?php endif; ?>

</div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(
	function ($) {
		$('#NumerosinvendidoSorteoId').bind(
			'change', 
			function (event) {
				$('#NumerosinvendidoCodigo').val('');
				$('#NumerosinvendidoSeleccionarSorteoForm').submit();
			}
		);
		$('#NumerosinvendidoCodigo').bind(
				'change', 
				function (event) {
					codigo = $('#NumerosinvendidoCodigo').val();
					if ( codigo.match(/([56]{1})([0-9]{3})([0-9]{1})([0-9]{2})([0-9]{3}).([0-9]{5})([0-9]{4})/) ) {
						$('#NumerosinvendidoSorteoId').val('');
						$('#NumerosinvendidoSeleccionarSorteoForm').submit();
					}
				}
			)
	}
);
//]]>
</script>
<?php
/*
	$this->Js->get('#NumerosinvendidoSorteoId');
	$this->Js->event(
		'change',
		$this->Js->request(
			array('controller' => 'sorteos', 'action' => 'get_form'),
			array(
				'async' => true, 
				'update' => '#formulario_sorteo',
				'data' => array('id' => '$("#NumerosinvendidoSorteoId").val()'), 
				'dataExpression' => true
			)
		)
	);
*/ 
?>