<div class="decimosconsignados view">
<h2><?php echo __('Número consignado'); ?></h2>
	<dl>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cantidad'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['cantidad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sorteo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($decimosconsignado['Sorteo']['titulo_express'], array('controller' => 'sorteos', 'action' => 'view', $decimosconsignado['Sorteo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha de consignación'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>