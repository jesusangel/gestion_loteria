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
