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
	public $displayField = 'numero';


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
			'dependent' => false,
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
