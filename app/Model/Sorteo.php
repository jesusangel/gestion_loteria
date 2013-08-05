<?php
App::uses('AppModel', 'Model');
/**
 * Sorteo Model
 *
 * @property Decimosconsignado $Decimosconsignado
 * @property Numerosvendido $Numerosvendido
 */
class Sorteo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'titulo';
	
	public $order = array('fecha' => 'ASC');
	
	public $virtualFields = array(
	    'titulo' => 'CONCAT(Sorteo.numero, " / ", Sorteo.anio, ", ", DATE_FORMAT(Sorteo.fecha, "%W %e de %M de %Y"))',
	    'titulo_corto' => 'CONCAT(Sorteo.numero, " / ", Sorteo.anio, ", ", DATE_FORMAT(Sorteo.fecha, "%d/%m/%Y"))',
	    'titulo_express' => 'CONCAT(Sorteo.numero, " / ", Sorteo.anio)'
	);


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Decimosconsignado' => array(
			'className' => 'Decimosconsignado',
			'foreignKey' => 'sorteo_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Numerosvendido' => array(
			'className' => 'Numerosvendido',
			'foreignKey' => 'sorteo_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Numerosinvendido' => array(
			'className' => 'Numerosinvendido',
			'foreignKey' => 'sorteo_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public static function calcularPrecioDecimo($numero_sorteo)
	{
		if ($numero_sorteo == Configure::read('numeroSorteoNino'))
		{
			// Sorteo del niño
			return Configure::read('numeroSorteoNino');
		}
		else if ($numero_sorteo == Configure::read('numeroSorteoNavidad'))
		{
			// Sorteo de navidad
			return Configure::read('precioDecimoNavidad');

		}
		else if ($numero_sorteo % 2 == 1)
		{
			// Sorteo de los jueves
			return Configure::read('precioDecimoJueves');
		}
		else
		{
			// Sorteo de los sábados
			return Configure::read('precioDecimoSabados');
		}

		return 0;
	}

	public static function calcularFechaSorteo($numero_sorteo, $anio_sorteo)
	{
		if ($numero_sorteo == Configure::read('numeroSorteoNino'))
		{
			// Sorteo del niño
			return new DateTime("{$anio_sorteo}-1-6");
		}
		else if ($numero_sorteo == Configure::read('numeroSorteoNavidad'))
		{
			// Sorteo de navidad
			return new DateTime("{$anio_sorteo}-12-22");

		}
		else
		{
			if ($numero_sorteo % 2 == 1)
			{
				$fecha_inicial = strtotime("thu jan {$anio_sorteo}");
			}
			else
			{
				$fecha_inicial = strtotime("sat jan {$anio_sorteo}");
			}
			 
			$numero_semana = 1 + floor(($numero_sorteo - 1) / 2);

			$semanas_transcurridas = $numero_semana - date('W', $fecha_inicial);

			$fecha = date('Y-m-d', strtotime("+{$semanas_transcurridas} week " . date('Y-m-d', $fecha_inicial)));
			return $fecha;
		}

		return false;
	}
}
