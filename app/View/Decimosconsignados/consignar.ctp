<div class="sorteos">
	<h2><?php echo __('Sorteo') . ' ' . $sorteo['Sorteo']['titulo']; ?></h2>
	<dl>
		<dt><?php echo __('Precio de los décimos'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['precio_x_decimo']); ?> €
			&nbsp;
		</dd>
	</dl>
</div>
<div>
	<h2><?php echo __('Consignar décimos'); ?></h2>
	
	<?php 
		echo $this->Form->create('modoConsignacion');
		echo $this->Form->select('modoConsignacion', $modosConsignacion, array(
			'label' => __('Modo de consignación'), 
			'empty' => false,
			'value' => $modoConsignacionSeleccionado));
		echo $this->Form->end();
	?>
</div>
<div class="decimosconsignados consignar">
	<h2><?php echo __('Décimos consignados en este sorteo'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('serie'); ?></th>
			<th><?php echo $this->Paginator->sort('fraccion'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($decimosconsignados as $decimosconsignado): ?>
	<tr>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['numero']); ?>&nbsp;</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['serie']); ?>&nbsp;</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['fraccion']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $decimosconsignado['Decimosconsignado']['id']), null, __('Are you sure you want to delete # %s?', $decimosconsignado['Decimosconsignado']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
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