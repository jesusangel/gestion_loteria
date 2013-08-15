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

<div>
	<fieldset>
		<legend><?php echo __('Anulación'); ?></legend>
	<?php
		echo $this->Form->create(null, array('action' => 'set_modo_invender'));
		echo $this->Form->input('modoInvender', array(
			'type' => 'select',
			'div' => false,
			'label' => __('Modo de anulación'),
			'options' => $modosInvender,
			'legend' => __('Modo de anulación seleccionado'), 
			'empty' => false,
			'value' => $modoInvenderSeleccionado));
		echo $this->Form->end();		
		
		echo $this->Form->create();
		echo $this->Form->hidden('sorteo_id', array('value' => $sorteo['Sorteo']['id']));
		
		switch ( $modoInvenderSeleccionado ) {
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
		
		echo $this->form->submit(__('Invender'), array('div' => false));
		echo $this->Form->end();
	?>
		</fieldset>
</div>
<div class="numerosinvendidos invender">
	<h2><?php echo __('Números invendidos en este sorteo'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('cantidad'); ?></th>
			<th><?php echo $this->Paginator->sort('created', __('Fecha de anulación')); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($numerosinvendidos as $numerosinvendido): ?>
	<tr>
		<td><?php echo h($numerosinvendido['Numerosinvendido']['numero']); ?>&nbsp;</td>
		<td><?php echo h($numerosinvendido['Numerosinvendido']['cantidad']); ?>&nbsp;</td>
		<td><?php echo $this->Time->niceshort($numerosinvendido['Numerosinvendido']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $numerosinvendido['Numerosinvendido']['id']), null, __('¿Seguro que quiere borrar el número # %s?', $numerosinvendido['Numerosinvendido']['numero'])); ?>
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
	$('#NumerosinvendidoModoInvender').change(function() {
		this.form.submit();
	});
});
</script>