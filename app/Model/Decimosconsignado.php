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
}
