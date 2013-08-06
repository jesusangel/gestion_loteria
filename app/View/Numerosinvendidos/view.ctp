<div class="numerosinvendidos view">
<h2><?php echo __('Numerosinvendido'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($numerosinvendido['Numerosinvendido']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($numerosinvendido['Numerosinvendido']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sorteo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($numerosinvendido['Sorteo']['titulo'], array('controller' => 'sorteos', 'action' => 'view', $numerosinvendido['Sorteo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cantidad'); ?></dt>
		<dd>
			<?php echo h($numerosinvendido['Numerosinvendido']['cantidad']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($numerosinvendido['Numerosinvendido']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($numerosinvendido['Numerosinvendido']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Numerosinvendido'), array('action' => 'edit', $numerosinvendido['Numerosinvendido']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Numerosinvendido'), array('action' => 'delete', $numerosinvendido['Numerosinvendido']['id']), null, __('¿Seguro que desea borrar # %s\?', $numerosinvendido['Numerosinvendido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Numerosinvendidos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Numerosinvendido'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
	</ul>
</div>
