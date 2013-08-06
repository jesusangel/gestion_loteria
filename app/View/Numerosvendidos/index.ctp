<div class="numerosvendidos index">
	<h2><?php echo __('Numerosvendidos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('sorteo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cantidad'); ?></th>
			<th><?php echo $this->Paginator->sort('venta_id'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($numerosvendidos as $numerosvendido): ?>
	<tr>
		<td><?php echo h($numerosvendido['Numerosvendido']['id']); ?>&nbsp;</td>
		<td><?php echo h($numerosvendido['Numerosvendido']['numero']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($numerosvendido['Sorteo']['numero'], array('controller' => 'sorteos', 'action' => 'view', $numerosvendido['Sorteo']['id'])); ?>
		</td>
		<td><?php echo h($numerosvendido['Numerosvendido']['cantidad']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($numerosvendido['Venta']['importe'], array('controller' => 'ventas', 'action' => 'view', $numerosvendido['Venta']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $numerosvendido['Numerosvendido']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $numerosvendido['Numerosvendido']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $numerosvendido['Numerosvendido']['id']), null, __('¿Seguro que desea borrar # %s\?', $numerosvendido['Numerosvendido']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Numerosvendido'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ventas'), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta'), array('controller' => 'ventas', 'action' => 'add')); ?> </li>
	</ul>
</div>
