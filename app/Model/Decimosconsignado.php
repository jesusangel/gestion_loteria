<?php
App::uses('AppModel', 'Model');
/**
 * Decimosconsignado Model
 *
 * @property Sorteo $Sorteo
 */
class Decimosconsignado extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'numero';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Sorteo' => array(
			'className' => 'Sorteo',
			'foreignKey' => 'sorteo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/*
 * 
 */	
	public function parseCodigo($codigo) {
		if ( preg_match('/([56]{1})([0-9]{3})([0-9]{1})([0-9]{2})([0-9]{3}).([0-9]{5})([0-9]{4})/', $codigo, $matches) != 1 ) {
			throw new Exception(__('Código no válido'));
		}
		
		$tipo_sorteo = (int) $matches[1];
		
		$numero_sorteo = (int) $matches[2];
		
		$precio_x_decimo = (int) Sorteo::calcularPrecioDecimo($numero_sorteo);
		
		$digito_anio = (int) $matches[3];
		$anio = (int) $this->_digito_anio_to_aaaa($digito_anio);

		$fecha_sorteo = Sorteo::calcularFechaSorteo($numero_sorteo, $anio);
		
		$fraccion = (int) $matches[4];
		if ( (int) $fraccion < 0 || (int) $fraccion > 10 ) {
			throw new Exception(__('La fracción del décimo no es correcta'));
		}
		
		$serie = (int) $matches[5];
		if ( (int) $serie < 1 || (int) $serie> Configure::read('serieMaxima') ) {
			throw new Exception(__('La serie del décimo no está dentro de los límites admitidos'));
		}
		
		$numero = (int) $matches[6];
		
		$codigo_seguridad = $matches[7];
		
		return compact(
			'tipo_sorteo',
			'numero_sorteo',
			'precio_x_decimo',
			'digito_anio',
			'anio',
			'fecha_sorteo',
			'fraccion',
			'serie',
			'numero',
			'codigo_seguridad'
		);
		
		
	}
	
	private function _digito_anio_to_aaaa($digito_anio) {
		// FIXME
		// año actual 2019 y da = 0 indica que el decimo es de 2020  
		// año actual 2021 y da = 0 indica que el decimo es de 2020
		// En la práctica el digito_anio será igual o superior en una unidad
		// al último dígito del año en curso.
		$fecha = new DateTime();
		$digito = $fecha->format('Y') % 10;
		if ($digito == $digito_anio)
		{
			return (int) $fecha->format('Y');
		}
		else if ($digito < $digito_anio )
		{
			return (int) $fecha->format('Y') + ($digito_anio - $digito);
		}
		else
		{
			return (int) $fecha->format('Y') - ($digito - $digito_anio);
		}
	}

	
}
