<div class="sorteos index">
	<h2><?php echo __('Sorteos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('numero'); ?></th>
			<th><?php echo $this->Paginator->sort('anio', __('Año')); ?></th>
			<th><?php echo $this->Paginator->sort('fecha', __('Fecha de celebración')); ?></th>
			<th><?php echo $this->Paginator->sort('Precio por décimo'); ?></th>
			
			<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php foreach ($sorteos as $sorteo): ?>
	<tr>
		<td><?php echo h($sorteo['Sorteo']['numero']); ?>&nbsp;</td>
		<td><?php echo h($sorteo['Sorteo']['anio']); ?>&nbsp;</td>
		<td><?php echo $this->Time->nice($sorteo['Sorteo']['fecha'], null, '%a %e de %b de %Y'); ?>&nbsp;</td>
		<td><?php echo $this->Number->currency($sorteo['Sorteo']['precio_x_decimo']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Ver'), array('action' => 'view', $sorteo['Sorteo']['id'])); ?>
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $sorteo['Sorteo']['id'])); ?>
			<?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $sorteo['Sorteo']['id']), null, __('¿Seguro que desea borrar # %s\?', $sorteo['Sorteo']['id'])); ?>
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