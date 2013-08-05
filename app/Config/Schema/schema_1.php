<?php 
class AppSchema extends CakeSchema {

	public $file = 'schema_1.php';

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $decimosconsignados = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => null),
		'sorteo_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'cantidad' => array('type' => 'integer', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	public $numerosvendidos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => null),
		'sorteo_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'cantidad' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 6),
		'venta_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	public $sorteos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'anio' => array('type' => 'integer', 'null' => false, 'default' => null),
		'precio_x_decimo' => array('type' => 'float', 'null' => false, 'default' => null),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'sorteo' => array('column' => array('numero', 'anio'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	public $ventas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'importe' => array('type' => 'float', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

}
