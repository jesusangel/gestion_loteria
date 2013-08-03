<div class="sorteos view">
<h2><?php echo __('Sorteo'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Anio'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['anio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio X Decimo'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['precio_x_decimo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['fecha']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sorteo'), array('action' => 'edit', $sorteo['Sorteo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sorteo'), array('action' => 'delete', $sorteo['Sorteo']['id']), null, __('Are you sure you want to delete # %s?', $sorteo['Sorteo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Decimosconsignados'), array('controller' => 'decimosconsignados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Decimosconsignado'), array('controller' => 'decimosconsignados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Numerosvendidos'), array('controller' => 'numerosvendidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Numerosvendido'), array('controller' => 'numerosvendidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Decimosconsignados'); ?></h3>
	<?php if (!empty($sorteo['Decimosconsignado'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Serie'); ?></th>
		<th><?php echo __('Fraccion'); ?></th>
		<th><?php echo __('Sorteo Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Fecha Invendido'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sorteo['Decimosconsignado'] as $decimosconsignado): ?>
		<tr>
			<td><?php echo $decimosconsignado['id']; ?></td>
			<td><?php echo $decimosconsignado['numero']; ?></td>
			<td><?php echo $decimosconsignado['serie']; ?></td>
			<td><?php echo $decimosconsignado['fraccion']; ?></td>
			<td><?php echo $decimosconsignado['sorteo_id']; ?></td>
			<td><?php echo $decimosconsignado['created']; ?></td>
			<td><?php echo $decimosconsignado['fecha_invendido']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'decimosconsignados', 'action' => 'view', $decimosconsignado['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'decimosconsignados', 'action' => 'edit', $decimosconsignado['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'decimosconsignados', 'action' => 'delete', $decimosconsignado['id']), null, __('Are you sure you want to delete # %s?', $decimosconsignado['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Decimosconsignado'), array('controller' => 'decimosconsignados', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Numerosvendidos'); ?></h3>
	<?php if (!empty($sorteo['Numerosvendido'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Sorteo Id'); ?></th>
		<th><?php echo __('Cantidad'); ?></th>
		<th><?php echo __('Venta Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sorteo['Numerosvendido'] as $numerosvendido): ?>
		<tr>
			<td><?php echo $numerosvendido['id']; ?></td>
			<td><?php echo $numerosvendido['numero']; ?></td>
			<td><?php echo $numerosvendido['sorteo_id']; ?></td>
			<td><?php echo $numerosvendido['cantidad']; ?></td>
			<td><?php echo $numerosvendido['venta_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'numerosvendidos', 'action' => 'view', $numerosvendido['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'numerosvendidos', 'action' => 'edit', $numerosvendido['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'numerosvendidos', 'action' => 'delete', $numerosvendido['id']), null, __('Are you sure you want to delete # %s?', $numerosvendido['id'])); ?>
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
