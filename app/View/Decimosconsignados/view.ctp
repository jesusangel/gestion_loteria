<div class="decimosconsignados view">
<h2><?php echo __('Decimosconsignado'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numero'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['numero']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Serie'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['serie']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fraccion'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['fraccion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sorteo'); ?></dt>
		<dd>
			<?php echo $this->Html->link($decimosconsignado['Sorteo']['numero'], array('controller' => 'sorteos', 'action' => 'view', $decimosconsignado['Sorteo']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fecha Invendido'); ?></dt>
		<dd>
			<?php echo h($decimosconsignado['Decimosconsignado']['fecha_invendido']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Decimosconsignado'), array('action' => 'edit', $decimosconsignado['Decimosconsignado']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Decimosconsignado'), array('action' => 'delete', $decimosconsignado['Decimosconsignado']['id']), null, __('Are you sure you want to delete # %s?', $decimosconsignado['Decimosconsignado']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Decimosconsignados'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Decimosconsignado'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sorteos'), array('controller' => 'sorteos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sorteo'), array('controller' => 'sorteos', 'action' => 'add')); ?> </li>
	</ul>
</div>
