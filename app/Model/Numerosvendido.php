<?php
App::uses('AppModel', 'Model');
/**
 * Numerosvendido Model
 *
 * @property Sorteo $Sorteo
 * @property Venta $Venta
 */
class Numerosvendido extends AppModel {

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
		),
		'Venta' => array(
			'className' => 'Venta',
			'foreignKey' => 'venta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
