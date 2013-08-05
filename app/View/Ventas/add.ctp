<div class="ventas">
<?php echo $this->Form->create('Venta'); ?>
	<fieldset>
		<legend><?php echo __('Nueva venta'); ?></legend>
	<?php
			echo $this->Form->input("codigo", array('value' => '', 'class' => 'focus', 'div' => false, 'size' => 20, 'maxlength' => 20));
			echo $this->Form->input("cantidad", array('div' => false, 'size' => 4, 'value' => 1));
			echo $this->Form->submit("Actualizar", array('div' => false, 'name' => 'aceptar'));
			echo '<div></div>';
			echo $this->Form->input('importe', array('label' => __('Total'), 'div' => false, 'size' => strlen($this->request->data('Venta.importe')) + 2, 'readonly' => true));
			echo $this->Form->input('pagado', array('div' => false, 'size' => strlen($this->request->data('Venta.importe')) + 2));
			echo $this->Form->input('cambio', array('div' => false, 'size' => strlen($this->request->data('Venta.importe')) + 2));
	?>
	<?php if ( count($this->request->data('Numerosvendido')) > 0 ) : ?>
		<div></div>
		<p>Recuerde que debe pulsar sobre <strong>Guardar</strong> cuando termine de añadir décimos para guardar la venta. Puede modificar la cantidad de décimos vendidos escribiendo la nueva cantidad en la casilla corresondiente. Para <strong>eliminar</strong> un número de la venta, introduzca <strong>0</strong> en la cantidad y pulse sobre <strong>"Actualizar"</strong>.</p>
		
		<table>
			<tr><th>Número</th><th>Sorteo</th><th>Cantidad</th><th>Precio ud.</th><th>Importe</th></tr>
		<?php 
		$i = count($this->request->data('Numerosvendido')) -1;
		do {
			echo '<tr>';
			echo '<td>' . $this->Form->input("Numerosvendido.{$i}.numero", array('label' => false, 'div' => false, 'size' => 5, 'readonly' => true)) . '</td>';
			echo '<td>' . $this->Form->input("Numerosvendido.{$i}.titulo_sorteo", array('label' => false, 'div' => false, 'size' => 5, 'readonly' => true)) . '</td>';
			echo '<td>' . $this->Form->input("Numerosvendido.{$i}.cantidad", array('label' => false, 'div' => false, 'size' => 4, 'readonly' => false)) . '</td>';
			echo '<td>' . $this->Form->input("Numerosvendido.{$i}.precio_x_decimo", array('label' => false, 'div' => false, 'size' => 4, 'readonly' => true)) . '</td>';
			echo '<td>' . 
				$this->Form->input("Numerosvendido.{$i}.importe", array('label' => false, 'div' => false, 'size' => 4, 'readonly' => true)) . 
				$this->Form->hidden("Numerosvendido.{$i}.sorteo_id") .
				'</td>';
			echo '</tr>';
		} while ( $i-- > 0 );
		endif;
		?>
		</table>
			<div></div>
	</fieldset>
<?php echo $this->Form->end(__('Guardar')); ?>
</div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(
	function ($) {
		$('#VentaPagado').bind(
			'change', 
			function (event) {
				cambio = $('#VentaPagado').val() - $('#VentaImporte').val();
				if ( cambio < 0 ) {
					alert('Cantidad insuficiente');
					$('#VentaPagado').val('');
					$('#VentaPagado').focus();
				} else {
					$('#VentaCambio').val( cambio );
				}
			}
		);
		$('#DecimosconsignadoCodigo').bind(
				'change', 
				function (event) {
					codigo = $('#DecimosconsignadoCodigo').val();
					if ( codigo.match(/([56]{1})([0-9]{3})([0-9]{1})([0-9]{2})([0-9]{3}).([0-9]{5})([0-9]{4})/) ) {
						$('#DecimosconsignadoSorteoId').val('');
						$('#DecimosconsignadoSeleccionarSorteoForm').submit();
					}
				}
			)
	}
);
//]]>
/*
$(document).ready(
	function() {
		$('.numero').bind('change', function(event) {
			var self = this;
			$.ajax({
				url: '/decimosconsignados/buscar/' + $(this).val()+'.json',
				success: function(data) {
					if ( matches = $(self).attr('id').match(/Numerosvendido([0-9]+)Numero/) ) {
						i = matches[1];
						$('#Numerosvendido'+i+'Cantidad').val(1);
						$('#Numerosvendido'+i+'SorteoId').val(data.decimo.Sorteo.id);
						$('#Numerosvendido'+i+'Importe').val(data.decimo.Sorteo.precio_x_decimo);
					}
				},
				error: function() {
					$(self).val('Código no válido');
				},
				statusCode: {
					404: function() {
						alert("Número no consignado");
						$(self).val('');
					}
				}
			}).done(function() {
			});
		});
	});
*/	
</script>