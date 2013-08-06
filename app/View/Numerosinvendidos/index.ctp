<div class="numerosinvendidos index">
	<h2><?php echo __('Numerosinvendidos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('sorteo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('cantidad'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($numerosinvendidos as $numerosinvendido): ?>
	<tr>
		<td><?php echo h($numerosinvendido['Numerosinvendido']['id']); ?>&nbsp;</td>
		<td><?php echo h($numerosinvendido['Numerosinvendido']['numero']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($numerosinvendido['Sorteo']['titulo'], array('controller' => 'sorteos', 'action' => 'view', $numerosinvendido['Sorteo']['id'])); ?>
		</td>
		<td><?php echo h($numerosinvendido['Numerosinvendido']['cantidad']); ?>&nbsp;</td>
		<td><?php echo h($numerosinvendido['Numerosinvendido']['created']); ?>&nbsp;</td>
		<td><?php echo h($numerosinvendido['Numerosinvendido']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $numerosinvendido['Numerosinvendido']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $numerosinvendido['Numerosinvendido']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $numerosinvendido['Numerosinvendido']['id']), null, __('¿Seguro que desea borrar # %s\?', $numerosinvendido['Numerosinvendido']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Numerosinvendido'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
	</ul>
</div>
