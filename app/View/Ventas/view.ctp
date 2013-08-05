<div class="ventas view">
<h2><?php echo __('Venta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($venta['Venta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Importe'); ?></dt>
		<dd>
			<?php echo h($venta['Venta']['importe']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($venta['Venta']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Venta'), array('action' => 'edit', $venta['Venta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Venta'), array('action' => 'delete', $venta['Venta']['id']), null, __('¿Seguro que desea borrar # %s\?', $venta['Venta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ventas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Numerosvendidos'), array('controller' => 'numerosvendidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Numerosvendido'), array('controller' => 'numerosvendidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Numerosvendidos'); ?></h3>
	<?php if (!empty($venta['Numerosvendido'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Sorteo Id'); ?></th>
		<th><?php echo __('Cantidad'); ?></th>
		<th><?php echo __('Venta Id'); ?></th>
		<th class="actions"><?php echo __('Acciones'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($venta['Numerosvendido'] as $numerosvendido): ?>
		<tr>
			<td><?php echo $numerosvendido['id']; ?></td>
			<td><?php echo $numerosvendido['numero']; ?></td>
			<td><?php echo $numerosvendido['sorteo_id']; ?></td>
			<td><?php echo $numerosvendido['cantidad']; ?></td>
			<td><?php echo $numerosvendido['venta_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'numerosvendidos', 'action' => 'view', $numerosvendido['id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('controller' => 'numerosvendidos', 'action' => 'edit', $numerosvendido['id'])); ?>
				<?php echo $this->Form->postLink(__('Borrar'), array('controller' => 'numerosvendidos', 'action' => 'delete', $numerosvendido['id']), null, __('¿Seguro que desea borrar # %s\?', $numerosvendido['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Numerosvendido'), array('controller' => 'numerosvendidos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
