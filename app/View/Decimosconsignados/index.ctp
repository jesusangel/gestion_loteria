<div class="decimosconsignados index">
	<h2><?php echo __('Listado de décimos consignados'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('sorteo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cantidad'); ?></th>
			<th><?php echo $this->Paginator->sort('created', __('Fecha de consignación')); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($decimosconsignados as $decimosconsignado): ?>
	<tr>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['numero']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($decimosconsignado['Sorteo']['titulo_express'], array('controller' => 'sorteos', 'action' => 'view', $decimosconsignado['Sorteo']['id'])); ?>
		</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['cantidad']); ?>&nbsp;</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $decimosconsignado['Decimosconsignado']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $decimosconsignado['Decimosconsignado']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $decimosconsignado['Decimosconsignado']['id']), null, __('¿Seguro que desea borrar # %s\?', $decimosconsignado['Decimosconsignado']['id'])); ?>
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
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Decimosconsignado'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
	</ul>
</div>
