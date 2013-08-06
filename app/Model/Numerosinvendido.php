<?php
App::uses('AppModel', 'Model');
App::uses('Sorteo', 'Model');
/**
 * Numerosinvendido Model
 *
 * @property Sorteo $Sorteo
 */
class Numerosinvendido extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'numero';

	public $validate = array(
		'numero' => array(
			'rule' => 'naturalNumber',
			'message' => 'El número debe ser mayor que cero'
		),
		'sorteo_id' => array(
			'rule' => 'naturalNumber',
			'message' => 'El ID del sorteo debe ser mayor que cero'
		),
		'venta_id' => array(
			'rule' => 'naturalNumber',
			'message' => 'El ID de la venta debe ser mayor que cero'
		),
	);
	
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
	public static function parseCodigo($codigo) {
		if ( preg_match('/([56]{1})([0-9]{3})([0-9]{1})([0-9]{2})([0-9]{3}).([0-9]{5})([0-9]{4})/', $codigo, $matches) != 1 ) {
			throw new Exception(__('Código no válido'));
		}
		
		$tipo_sorteo = (int) $matches[1];
		
		$numero_sorteo = (int) $matches[2];
		
		$precio_x_decimo = (int) Sorteo::calcularPrecioDecimo($numero_sorteo);
		
		$digito_anio = (int) $matches[3];
		$anio = (int) self::_digito_anio_to_aaaa($digito_anio);

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
	
	private static function _digito_anio_to_aaaa($digito_anio) {
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

	/**
	 * @throws SorteoNoEncontradoException
	 * @throws SorteoNoEncontradoException
	 * @throws DecimoAjenoException  
	 */
	public function invender_series($sorteo_id, $codigo_o_numero, $serie_inicial, $serie_final) {
		if ( $sorteo_id <= 0 ) {
			throw new SorteoNoEncontradoException(__('No se ha especificado el ID del sorteo'));
		}
		$opciones_sorteo = array(
			'conditions' => array('Sorteo.id' => $sorteo_id),
			'contain' => false
		);
		if ( !$sorteo = $this->Sorteo->find('first', $opciones_sorteo) ) {
			throw new SorteoNoEncontradoException();
		}
		if ( (strtotime($sorteo['Sorteo']['fecha']) - time()) < 0 ) {
			throw new SorteoCelebradoException();
		}
		
		if ( strlen($codigo_o_numero) == Configure::read('longitudCodigoDecimo') ) {
			$datos_de_codigo = self::parseCodigo($codigo_o_numero);
			
			if ( $datos_de_codigo['numero_sorteo'] != $sorteo['Sorteo']['numero'] || $datos_de_codigo['anio'] != $sorteo['Sorteo']['anio'] ) {
				throw new DecimoAjenoException();
			}
			
			$numero = (int) $datos_de_codigo['numero'];
		} else {
			if ( $codigo_o_numero <= 0 || $codigo_o_numero > Configure::read('numeroMaximo') ) {
				throw new UnexpectedValueException(__('El número introducido no está dentro de los márgenes admitidos: 0 - ' . Configure::read('numeroMaximo')));
			}
			$numero = (int) $codigo_o_numero; 
		}
		
		if ( $serie_inicial <= 0 || $serie_inicial > Configure::read('serieMaxima') ) {
			throw new UnexpectedValueException(__('La serie inicial no está dentro de los márgenes admitidos: 1 - ' . Configure::read('serieMaxima')));
		}
		
		if ( $serie_final <= 0 || $serie_final > Configure::read('serieMaxima') ) {
			throw new UnexpectedValueException(__('La serie final no está dentro de los márgenes admitidos: 1 - ' . Configure::read('serieMaxima')));
		}

		$cantidad_a_invender = (abs($serie_final - $serie_inicial) + 1) * 10;
		if ( $decimo = $this->find('first', array('contain' => false, 'fields' => array('id', 'cantidad'), 'conditions' => array('Numerosinvendido.numero' => $numero, 'Numerosinvendido.sorteo_id' => $sorteo['Sorteo']['id']))) ) {
			$decimo['Numerosinvendido']['cantidad'] += $cantidad_a_invender;
		} else {
			$decimo = array('Numerosinvendido' => array(
							'numero' => $numero,
							'sorteo_id' => $sorteo['Sorteo']['id'],
							'cantidad' => $cantidad_a_invender
			));
		}
		
		$this->create();
		if ( $this->save($decimo) ) {
			return $cantidad_a_invender;
		} else {
			return 0;
		}
	}	
}
