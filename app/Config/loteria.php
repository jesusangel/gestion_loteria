<?php
$config = array(
	'longitudCodigoDecimo' => 20,
	'numeroMaximo' => 99999,
	'serieMaxima' => 999,
	'precioDecimoJueves' => 3,
	'precioDecimoSabados' => 6,
	'precioDecimoNino' => 20,
	'precioDecimoNavidad' => 20,
	'numeroSorteoNino' => 2,
	'numeroSorteoNavidad' => 102,
	'maximoNumeroSorteo' => 103,
	// opciones: individual, fraccion, billete, series
	'modoConsignacionDecimos' => 'series',
	'modoInvenderDecimos' => 'series',
);

/*
Configure::write('longitudCodigoDecimo', 20);
Configure::write('numeroMaximo', 99999);
Configure::write('serieMaxima', 999);
Configure::write('precioDecimoJueves', 3);
Configure::write('precioDecimoSabados', 6);
Configure::write('precioDecimoNino', 20);
Configure::write('precioDecimoNavidad', 20);
Configure::write('numeroSorteoNino', 2);
Configure::write('numeroSorteoNavidad', 102);
Configure::write('maximoNumeroSorteo', 103);
// opciones: individual, fraccion, billete, series
Configure::write('modoEntradaDecimos', 'series');
Configure::write('modoAnulacionDecimos', 'series');
*/