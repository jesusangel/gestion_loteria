<div class="decimosconsignados index">
	<h2><?php echo __('Decimosconsignados'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('serie'); ?></th>
			<th><?php echo $this->Paginator->sort('fraccion'); ?></th>
			<th><?php echo $this->Paginator->sort('sorteo_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('fecha_invendido'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($decimosconsignados as $decimosconsignado): ?>
	<tr>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['id']); ?>&nbsp;</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['numero']); ?>&nbsp;</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['serie']); ?>&nbsp;</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['fraccion']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($decimosconsignado['Sorteo']['numero'], array('controller' => 'sorteos', 'action' => 'view', $decimosconsignado['Sorteo']['id'])); ?>
		</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['created']); ?>&nbsp;</td>
		<td><?php echo h($decimosconsignado['Decimosconsignado']['fecha_invendido']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $decimosconsignado['Decimosconsignado']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $decimosconsignado['Decimosconsignado']['id'])); ?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Decimosconsignado'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
	</ul>
</div>
