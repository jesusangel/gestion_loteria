<div class="numerosvendidos view">
<h2><?php echo __('Numerosvendido'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($numerosvendido['Numerosvendido']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($numerosvendido['Numerosvendido']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sorteo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($numerosvendido['Sorteo']['numero'], array('controller' => 'sorteos', 'action' => 'view', $numerosvendido['Sorteo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cantidad'); ?></dt>
		<dd>
			<?php echo h($numerosvendido['Numerosvendido']['cantidad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Venta'); ?></dt>
		<dd>
			<?php echo $this->Html->link($numerosvendido['Venta']['importe'], array('controller' => 'ventas', 'action' => 'view', $numerosvendido['Venta']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Numerosvendido'), array('action' => 'edit', $numerosvendido['Numerosvendido']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Numerosvendido'), array('action' => 'delete', $numerosvendido['Numerosvendido']['id']), null, __('Are you sure you want to delete # %s?', $numerosvendido['Numerosvendido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Numerosvendidos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Numerosvendido'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ventas'), array('controller' => 'ventas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Venta'), array('controller' => 'ventas', 'action' => 'add')); ?> </li>
	</ul>
</div>
