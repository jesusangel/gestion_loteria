<div class="decimosconsignados form">
<?php echo $this->Form->create('Decimosconsignado'); ?>
	<fieldset>
		<legend><?php echo __('Seleccione el sorteo para consignar'); ?></legend>
	<?php
		echo $this->Form->input('sorteo_id', array(
			'empty' => __('Seleccione un sorteo de la lista o "escanee" un décimo'),
			'tabindex' => 2
		));		
		echo $this->Form->input('codigo', array(
			'label' => __('Código del décimo'),
			'maxlength' => 20,
			'size' => 20,
			'class' => 'focus',
			'tabindex' => 1
		));
		echo $this->Html->tag('div', '', array('id' => 'mensajeCodigo', 'class' => 'error-message', 'style' => 'margin-left: 20%'));
	?>
	</fieldset>	
<?php echo $this->Form->end(); ?>

<?php if ( $this->request->data('Sorteo') ) : ?>
<div class="sorteos">
<?php 
	if ( !isset($this->request->data['Sorteo']['id']) ) {
		echo $this->Form->create('Sorteo', array('url' => array('controller' => 'sorteos', 'action' => 'add')));
	} else {
		echo $this->Form->create('Sorteo', array('url' => array('controller' => 'sorteos', 'action' => 'edit')));
	}
?>
	<fieldset>
		<legend><?php echo __('Sorteo seleccionado'); ?></legend>
		<?php if ( !isset($this->request->data['Sorteo']['id']) ) : ?>
		<p>Va a consignar décimos en un sorteo nuevo. Por favor, compruebe que los datos que aparecen a continuación son correctos.</p>
		<?php endif; ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('numero', array('size' => 3, 'maxlength' => 3));
		echo $this->Form->input('anio', array('size' => 4, 'maxlength' => 4));
		echo $this->Form->input('precio_x_decimo', array('value' => 0 + $this->request->data['Sorteo']['precio_x_decimo'], 'size' => 5, 'maxlength' => 5));
		echo $this->Form->input('fecha', array('dateFormat' => 'DMY', 'minYear' => date('Y'), 'maxYear' => date('Y') + 1));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Continuar con la consignación')); ?>
</div>
<?php endif; ?>

</div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(
	function ($) {
		$('#DecimosconsignadoSorteoId').bind(
			'change', 
			function (event) {
				$('#DecimosconsignadoCodigo').val('');
				$('#DecimosconsignadoSeleccionarSorteoForm').submit();
			}
		);
		$('#DecimosconsignadoCodigo').bind(
				'change', 
				function (event) {
					self = this;
					codigo = $(this).val();
					if ( codigo.match(/([56]{1})([0-9]{3})([0-9]{1})([0-9]{2})([0-9]{3}).([0-9]{5})([0-9]{4})/) ) {
						$('#DecimosconsignadoSorteoId').val('');
						$('#DecimosconsignadoSeleccionarSorteoForm').submit();
					} else {
						$(this).val('');
						$('#mensajeCodigo').html('Código no válido');
						setTimeout(function () {
				            $(self).focus();
				        }, 10);
					}
				}
			)
	}
);
//]]>
</script>
<?php
/*
	$this->Js->get('#DecimosconsignadoSorteoId');
	$this->Js->event(
		'change',
		$this->Js->request(
			array('controller' => 'sorteos', 'action' => 'get_form'),
			array(
				'async' => true, 
				'update' => '#formulario_sorteo',
				'data' => array('id' => '$("#DecimosconsignadoSorteoId").val()'), 
				'dataExpression' => true
			)
		)
	);
*/ 
?>