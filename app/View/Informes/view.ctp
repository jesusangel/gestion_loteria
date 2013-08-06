<div class="informes form">
<?php echo $this->Form->create('Informe', array('action' => 'view')); ?>
	<fieldset>
		<legend><?php echo __('Rango de fechas'); ?></legend>
	<?php
			echo $this->Form->input("fecha_inicial", array('type' => 'date', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 5, 'maxYear' => date('Y') + 1));
			echo $this->Form->input("fecha_final", array('type' => 'date', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 5, 'maxYear' => date('Y') + 1));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Aceptar')); ?>
</div>

<div class="informes view">
<h2><?php echo __('Consignaciones, ventas y anulaciones realizadas durante este periodo'); ?></h2>
<h3><?php echo __('Consignaciones'); ?></h3>
<table>
	<tr><th>Sorteo</th><th>Precio por décimo</th><th>Cantidad</th><th>Importe</th></tr>
	<?php
		$importe_total_consignado = 0;
		$decimos_consignados = 0;
		for ( $i = 0; $i < count($consignados); $i++ ) {
			$importe_total_consignado += $importe_parcial = $consignados[$i]['Decimosconsignado']['Cantidad'] * $consignados[$i]['Sorteo']['precio_x_decimo'];
			$decimos_consignados += $consignados[$i]['Decimosconsignado']['Cantidad'];
			echo '<tr>';
			echo "<td>{$consignados[$i]['Sorteo']['numero']} / {$consignados[$i]['Sorteo']['anio']}</td>";
			echo '<td>'.$this->Number->currency($consignados[$i]['Sorteo']['precio_x_decimo']).'</td>';
			echo '<td>'.$this->Number->format($consignados[$i]['Decimosconsignado']['Cantidad']).'</td>';
			echo '<td>'.$this->Number->currency($importe_parcial).'</td>';
			echo '</tr>';
		}
	?>
</table>
<p>Total de consignaciones: <strong><?php echo $this->Number->format($decimos_consignados); ?></strong> décimos consignados por un importe de <strong><?php echo $this->Number->currency($importe_total_consignado); ?></strong></p>

<h3><?php echo __('Ventas'); ?></h3>
<table>
	<tr><th>Sorteo</th><th>Precio por décimo</th><th>Cantidad</th><th>Importe</th></tr>
	<?php
		$importe_total_vendido = 0;
		$decimos_vendidos = 0;
		for ( $i = 0; $i < count($vendidos); $i++ ) {
			$importe_total_vendido += $importe_parcial = $vendidos[$i]['Numerosvendido']['Cantidad'] * $vendidos[$i]['Sorteo']['precio_x_decimo'];
			$decimos_vendidos += $vendidos[$i]['Numerosvendido']['Cantidad'];
			echo '<tr>';
			echo "<td>{$vendidos[$i]['Sorteo']['numero']} / {$vendidos[$i]['Sorteo']['anio']}</td>";
			echo '<td>'.$this->Number->currency($vendidos[$i]['Sorteo']['precio_x_decimo']).'</td>';
			echo '<td>'.$this->Number->format($vendidos[$i]['Numerosvendido']['Cantidad']).'</td>';
			echo '<td>'.$this->Number->currency($importe_parcial).'</td>';
			echo '</tr>';
		}
	?>
</table>
<p>Total de ventas: <strong><?php echo $this->Number->format($decimos_vendidos); ?></strong> décimos vendidos por un importe de <strong><?php echo $this->Number->currency($importe_total_vendido); ?></strong></p>

<h3><?php echo __('Anulaciones'); ?></h3>
<table>
	<tr><th>Sorteo</th><th>Precio por décimo</th><th>Cantidad</th><th>Importe</th></tr>
	<?php
		$importe_total_invendido = 0;
		$decimos_invendidos = 0;
		for ( $i = 0; $i < count($invendidos); $i++ ) {
			$importe_total_invendido += $importe_parcial = $invendidos[$i]['Numerosinvendido']['Cantidad'] * $invendidos[$i]['Sorteo']['precio_x_decimo'];
			$decimos_invendidos += $invendidos[$i]['Numerosinvendido']['Cantidad'];
			echo '<tr>';
			echo "<td>{$invendidos[$i]['Sorteo']['numero']} / {$invendidos[$i]['Sorteo']['anio']}</td>";
			echo '<td>'.$this->Number->currency($invendidos[$i]['Sorteo']['precio_x_decimo']).'</td>';
			echo '<td>'.$this->Number->format($invendidos[$i]['Numerosinvendido']['Cantidad']).'</td>';
			echo '<td>'.$this->Number->currency($importe_parcial).'</td>';
			echo '</tr>';
		}
	?>
</table>
<p>Total de anulaciones: <strong><?php echo $this->Number->format($decimos_invendidos); ?></strong> décimos invendidos por un importe de <strong><?php echo $this->Number->currency($importe_total_invendido); ?></strong></p>
</div>


<div class="sorteos index">
	<h2><?php echo __('Sorteos celebrados durante este periodo'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Número'); ?></th>
			<th><?php echo __('Año'); ?></th>
			<th><?php echo __('Fecha de celebración'); ?></th>
			<th><?php echo __('Precio por décimo'); ?></th>
			<th><?php echo __('Décimos consignados'); ?></th>
			<th><?php echo __('Décimos vendidos'); ?></th>
			<th><?php echo __('Décimos invendidos'); ?></th>
	</tr>
	<?php foreach ($sorteos as $sorteo): ?>
	<tr>
		<td><?php echo h($sorteo['Sorteo']['numero']); ?>&nbsp;</td>
		<td><?php echo h($sorteo['Sorteo']['anio']); ?>&nbsp;</td>
		<td><?php echo $this->Time->nice($sorteo['Sorteo']['fecha'], null, '%a %e de %b de %Y'); ?>&nbsp;</td>
		<td><?php echo $this->Number->currency($sorteo['Sorteo']['precio_x_decimo']); ?>&nbsp;</td>
		<td><?php echo $this->Number->format($sorteo['Sorteo']['Consignados']) . ' (' . $this->Number->currency($sorteo['Sorteo']['Consignados'] * $sorteo['Sorteo']['precio_x_decimo']) . ')'?>
		<td><?php echo $this->Number->format($sorteo['Sorteo']['Vendidos']) . ' (' . $this->Number->currency($sorteo['Sorteo']['Vendidos'] * $sorteo['Sorteo']['precio_x_decimo']) . ')'?>
		<td><?php echo $this->Number->format($sorteo['Sorteo']['Invendidos']) . ' (' . $this->Number->currency($sorteo['Sorteo']['Invendidos'] * $sorteo['Sorteo']['precio_x_decimo']) . ')'?>
	</tr>
<?php endforeach; ?>
	</table>
</div>