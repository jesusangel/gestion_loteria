<?php
App::uses('AppModel', 'Model');
/**
 * Venta Model
 *
 * @property Numerosvendido $Numerosvendido
 */
class Venta extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'importe';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Numerosvendido' => array(
			'className' => 'Numerosvendido',
			'foreignKey' => 'venta_id',
			'dependent' => false,
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

}
