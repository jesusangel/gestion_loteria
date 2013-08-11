<div class="sorteos view">
<h2><?php echo __('Sorteo'); ?></h2>
	<dl>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Año'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['anio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio por decimo'); ?></dt>
		<dd>
			<?php echo $this->Number->currency($sorteo['Sorteo']['precio_x_decimo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha de celebración'); ?></dt>
		<dd>
			<?php echo h($sorteo['Sorteo']['fecha']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Décimos consignados'); ?></dt>
		<dd>
			<?php echo $this->Number->format($totalDecimosConsignados); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Décimos vendidos'); ?></dt>
		<dd>
			<?php echo $this->Number->format($totalDecimosVendidos); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Décimos invendidos'); ?></dt>
		<dd>
			<?php echo $this->Number->format($totalDecimosInvendidos); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Consignaciones'); ?></h3>
	<?php if (!empty($sorteo['Decimosconsignado'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Cantidad'); ?></th>
		<th><?php echo __('Fecha de consignación'); ?></th>
		<!--  <th class="actions"><?php echo __('Acciones'); ?></th> -->
	</tr>
	<?php
		$i = 0;
		foreach ($sorteo['Decimosconsignado'] as $decimosconsignado): ?>
		<tr>
			<td><?php echo $decimosconsignado['numero']; ?></td>
			<td><?php echo $decimosconsignado['cantidad']; ?></td>
			<td><?php echo $this->Time->niceshort($decimosconsignado['created']); ?></td>
			<!-- 
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'decimosconsignados', 'action' => 'view', $decimosconsignado['id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('controller' => 'decimosconsignados', 'action' => 'edit', $decimosconsignado['id'])); ?>
				<?php echo $this->Form->postLink(__('Borrar'), array('controller' => 'decimosconsignados', 'action' => 'delete', $decimosconsignado['id']), null, __('¿Seguro que desea borrar # %s\?', $decimosconsignado['id'])); ?>
			</td>
			 -->
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Ventas'); ?></h3>
	<?php if (!empty($sorteo['Numerosvendido'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Cantidad'); ?></th>
		<th><?php echo __('Fecha de venta'); ?></th>
		<!-- <th class="actions"><?php echo __('Acciones'); ?></th> -->
	</tr>
	<?php
		$i = 0;
		foreach ($sorteo['Numerosvendido'] as $numerosvendido): ?>
		<tr>
			<td><?php echo $numerosvendido['numero']; ?></td>
			<td><?php echo $numerosvendido['cantidad']; ?></td>
			<td><?php echo $this->Time->niceshort($numerosvendido['Venta']['created']); ?></td>
			<!-- 
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'numerosvendidos', 'action' => 'view', $numerosvendido['id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('controller' => 'numerosvendidos', 'action' => 'edit', $numerosvendido['id'])); ?>
				<?php echo $this->Form->postLink(__('Borrar'), array('controller' => 'numerosvendidos', 'action' => 'delete', $numerosvendido['id']), null, __('¿Seguro que desea borrar # %s\?', $numerosvendido['id'])); ?>
			</td>
			 -->
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Anulaciones'); ?></h3>
	<?php if (!empty($sorteo['Numerosinvendido'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Cantidad'); ?></th>
		<th><?php echo __('Fecha de anulación'); ?></th>
		<!-- <th class="actions"><?php echo __('Acciones'); ?></th> -->
	</tr>
	<?php
		$i = 0;
		foreach ($sorteo['Numerosinvendido'] as $numerosinvendido): ?>
		<tr>
			<td><?php echo $numerosinvendido['numero']; ?></td>
			<td><?php echo $numerosinvendido['cantidad']; ?></td>
			<td><?php echo $this->Time->niceshort($numerosinvendido['created']); ?></td>
			<!-- 
			<td class="actions">
				<?php echo $this->Html->link(__('Ver'), array('controller' => 'numerosinvendidos', 'action' => 'view', $numerosinvendido['id'])); ?>
				<?php echo $this->Html->link(__('Editar'), array('controller' => 'numerosinvendidos', 'action' => 'edit', $numerosinvendido['id'])); ?>
				<?php echo $this->Form->postLink(__('Borrar'), array('controller' => 'numerosinvendidos', 'action' => 'delete', $numerosinvendido['id']), null, __('¿Seguro que desea borrar # %s\?', $numerosinvendido['id'])); ?>
			</td>
			 -->
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
