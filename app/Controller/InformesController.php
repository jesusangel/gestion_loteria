<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Informes Controller
 *
 * @property Informe $Informe
 */
class InformesController extends AppController {
	
	var $uses = array('Sorteo', 'Decimosconsignado', 'Numerosinvendido', 'Numerosvendido', 'Venta');

	public function index() {
		$fecha_inicial = new DateTime();
		$fecha_final = new DateTime();
		
		$this->request->data('Informe.fecha_inicial', date('Y-m-d', strtotime('-1 month')));
		$this->request->data('Informe.fecha_final', date('Y-m-d'));
		
		$this->set(compact('fecha_inicial', 'fecha_final'));
	}
	
	public function view() {
		$str_fecha_inicial = $this->request->data('Informe.fecha_inicial.year') .'-'. $this->request->data('Informe.fecha_inicial.month') .'-'. $this->request->data('Informe.fecha_inicial.day'); 
		$str_fecha_final = $this->request->data('Informe.fecha_final.year') .'-'. $this->request->data('Informe.fecha_final.month') .'-'. $this->request->data('Informe.fecha_final.day');
		/*$sorteos = $this->Sorteo->find('all', array(
			'conditions' => array(
				CakeTime::daysAsSql($str_fecha_inicial, $str_fecha_final, 'fecha')
			),
			'contain' => array(
				'Decimosconsignado' => 'sum(cantidad)',
				'Numerosvendido',
				'Numerosinvendido'
			),
			'group' => 'Sorteo.id'
		));*/
		$this->Sorteo->virtualFields['Consignados'] = 0;
		$this->Sorteo->virtualFields['Vendidos'] = 0;
		$this->Sorteo->virtualFields['Invendidos'] = 0;
		$sorteos = $this->Sorteo->query("
			SELECT 
				Sorteo.id, Sorteo.numero, Sorteo.anio, Sorteo.precio_x_decimo, Sorteo.fecha, 
				SUM(Decimosconsignado.cantidad) AS Sorteo__Consignados, 
				SUM(Numerosvendido.cantidad) AS Sorteo__Vendidos, 
				SUM(Numerosinvendido.cantidad) AS Sorteo__Invendidos 
			FROM 
				sorteos AS Sorteo 
			LEFT JOIN 
				decimosconsignados AS Decimosconsignado
			ON
				Decimosconsignado.sorteo_id = Sorteo.id
			LEFT JOIN 
				numerosvendidos AS Numerosvendido
			ON
				Numerosvendido.sorteo_id = Sorteo.id
			LEFT JOIN 
				numerosinvendidos AS Numerosinvendido
			ON
				Numerosinvendido.sorteo_id = Sorteo.id
			WHERE
				".CakeTime::daysAsSql($str_fecha_inicial, $str_fecha_final, 'Sorteo.fecha')."
			GROUP BY
				Sorteo.id
		");
		
		$this->Decimosconsignado->virtualFields['Cantidad'] = 0;
		$consignados = $this->Decimosconsignado->query("
			SELECT 
				SUM(Decimosconsignado.cantidad) AS Decimosconsignado__Cantidad,
				Sorteo.precio_x_decimo, 
				Sorteo.numero,
				Sorteo.anio
			FROM 
				decimosconsignados AS Decimosconsignado,
				sorteos AS Sorteo
			WHERE 
				Sorteo.id = Decimosconsignado.sorteo_id
			AND
				".CakeTime::daysAsSql($str_fecha_inicial, $str_fecha_final, 'Decimosconsignado.created')."
			GROUP BY
				Sorteo.id
		");
		
		$this->Numerosvendido->virtualFields['Cantidad'] = 0;
		$vendidos = $this->Numerosvendido->query("
			SELECT 
				SUM(Numerosvendido.cantidad) AS Numerosvendido__Cantidad,
				Sorteo.precio_x_decimo, 
				Sorteo.numero,
				Sorteo.anio
			FROM 
				numerosvendidos AS Numerosvendido,
				sorteos AS Sorteo,
				ventas AS Venta
			WHERE 
				Venta.id = Numerosvendido.venta_id
			AND
				Sorteo.id = Numerosvendido.sorteo_id
			AND
				".CakeTime::daysAsSql($str_fecha_inicial, $str_fecha_final, 'Venta.created')."
			GROUP BY
				Sorteo.id
		");
		
		$this->Numerosinvendido->virtualFields['Cantidad'] = 0;
		$invendidos = $this->Numerosinvendido->query("
			SELECT 
				SUM(Numerosinvendido.cantidad) AS Numerosinvendido__Cantidad,
				Sorteo.precio_x_decimo, 
				Sorteo.numero,
				Sorteo.anio
			FROM 
				numerosinvendidos AS Numerosinvendido,
				sorteos AS Sorteo
			WHERE 
				Sorteo.id = Numerosinvendido.sorteo_id
			AND
				".CakeTime::daysAsSql($str_fecha_inicial, $str_fecha_final, 'Numerosinvendido.created')."
			GROUP BY
				Sorteo.id
		");
		
		$this->set(compact('sorteos', 'consignados', 'invendidos', 'vendidos', 'str_fecha_inicial', 'str_fecha_final'));
	}

}
