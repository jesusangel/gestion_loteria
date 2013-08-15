<fieldset>
	<legend><?php echo __('Sorteo') . ' ' . $sorteo['Sorteo']['titulo']; ?></legend>
	<dl>
		<dt><?php echo __('Precio de los décimos'); ?></dt>
		<dd>
			<?php echo $this->Number->currency($sorteo['Sorteo']['precio_x_decimo']); ?>
			&nbsp;
		</dd>
	</dl>
</fieldset>

<div class="consignacion">
	<fieldset>
		<legend><?php echo __('Consignación'); ?></legend>
	<?php
		echo $this->Form->create(null, array('action' => 'set_modo_consignacion'));
		echo $this->Form->input('modoConsignacion', array(
			'type' => 'select',
			'div' => false,
			'label' => __('Modo de consignación'),
			'options' => $modosConsignacion,
			'legend' => __('Modo de consignación seleccionado'), 
			'empty' => false,
			'value' => $modoConsignacionSeleccionado));
		echo $this->Form->end();
	
		echo $this->Form->create();
		echo $this->Form->hidden('sorteo_id', array('value' => $sorteo['Sorteo']['id']));
		
		switch ( $modoConsignacionSeleccionado ) {
			case 'individual':
			case 'fraccion':
			case 'billete':
				echo $this->Form->input('codigo', array('class' => 'focus', 'div' => false, 'label' => __('Código o número del décimo'), 'size' => 20, 'maxlength' => 20));				
			break;
			default:	
				echo $this->Form->input('codigo', array('class' => 'focus', 'div' => false, 'label' => __('Código o número del décimo'), 'size' => 20, 'maxlength' => 20));
				echo $this->Form->input('serieInicial', array('div' => false, 'size' => 3, 'maxlength' => 3));
				echo $this->Form->input('serieFinal', array('div' => false, 'size' => 3, 'maxlength' => 3));
			break;
		}	
		echo $this->form->submit(__('Consignar'), array('div' => false));
		echo $this->Form->end();
	?>
	</fieldset>
</div>
<div class="decimosconsignados consignar">
	<h2><?php echo __('Consignaciones en este sorteo'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('cantidad'); ?></th>
			<th><?php echo $this->Paginator->sort('created', __('Fecha de consignación')); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($decimosconsignados as $decimosconsignado): ?>
	<tr>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['numero']); ?>&nbsp;</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['cantidad']); ?>&nbsp;</td>
		<td><?php echo $this->Time->niceshort($decimosconsignado['Decimosconsignado']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $decimosconsignado['Decimosconsignado']['id']), null, __('¿Seguro que quiere borrar el número # %s?', $decimosconsignado['Decimosconsignado']['numero'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de {:count} totales, comenzando en {:start}, terminando en {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#DecimosconsignadoModoConsignacion').change(function() {
		this.form.submit();
	});
});
</script>