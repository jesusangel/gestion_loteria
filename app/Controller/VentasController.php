<?php
App::uses('AppController', 'Controller');
/**
 * Ventas Controller
 *
 * @property Venta $Venta
 */
class VentasController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Venta->recursive = 0;
		$this->set('ventas', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Venta->exists($id)) {
			throw new NotFoundException(__('Invalid venta'));
		}
		$options = array('conditions' => array('Venta.' . $this->Venta->primaryKey => $id));
		$this->set('venta', $this->Venta->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			if ( $this->request->data('aceptar') ) {
				$this->loadModel('Decimosconsignado');
				
				try {
					// Se trata de añadir un décimo a la venta o actualizar la lista
					if ( trim($this->request->data('Venta.codigo')) != '' ) {
						$datos_codigo = Decimosconsignado::parseCodigo($this->request->data('Venta.codigo'));
						$opciones_decimo = array('conditions' => array(
							'Decimosconsignado.numero' => $datos_codigo['numero'],
							'Sorteo.numero' => $datos_codigo['numero_sorteo'],
							'Sorteo.anio' => $datos_codigo['anio']  
						));
						
						if ( $decimo = $this->Decimosconsignado->find('first', $opciones_decimo) ) {
							$idx_nuevo_numero = count($this->request->data('Numerosvendido'));
							$importe_numero = (0 + $this->request->data('Venta.cantidad')) * $decimo['Sorteo']['precio_x_decimo'];
							
							$this->request->data('Numerosvendido.' . $idx_nuevo_numero, array(
								'numero' => $datos_codigo['numero'], 
								'cantidad' => (0 + $this->request->data('Venta.cantidad')), 
								'precio_x_decimo' => $decimo['Sorteo']['precio_x_decimo'],
								'sorteo_id' => $decimo['Sorteo']['id'], 
								'importe' => $importe_numero,
								'titulo_sorteo' => $decimo['Sorteo']['titulo_corto']
							));
						} else {
							$this->Session->setFlash(__('Décimo no consignado'));
						}
					}
					
					// Actualizamos la lista de décimos añadidos a la venta
					$importe_total = 0;
					if ( count($this->request->data('Numerosvendido')) > 0 ) {
						foreach ( $this->request->data('Numerosvendido') as $idx => $numero ) {
							$cantidad = $numero['cantidad'];
							$importe_numero = $cantidad * $numero['precio_x_decimo'];
							if ( $cantidad <= 0 ) {
								$this->request->data('Numerosvendido.' . $idx, null);
							} else {
								$this->request->data('Numerosvendido.' . $idx . '.importe', $importe_numero );
							}
							$importe_total += $importe_numero;
						}
					}
					$this->request->data('Venta.importe', $importe_total);
				} catch ( Exception $e ) {
					$this->Session->setFlash( $e->getMessage() );
				}
			} else {
				// Guardamos la venta y los números vendidos
				if ( count($this->request->data('Numerosvendido')) > 0 ) {
					// Primero eliminamos los registros vacíos
					foreach ( $this->request->data('Numerosvendido') as $idx => $numero ) {
						if ( empty($numero['numero']) || empty($numero['cantidad']) ) {
							unset($this->request->data['Numerosvendido'][$idx]);
						}
					}
				}
				
				$this->Venta->create();
				if ($this->Venta->saveAll($this->request->data)) {
					$this->Session->setFlash(__('Venta guardada'));
					$this->redirect(array('action' => 'add'));
				} else {
					$this->Session->setFlash(__('No se pudo guardar la venta. Por favor, inténtelo de nuevo.'));
				}
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Venta->exists($id)) {
			throw new NotFoundException(__('Invalid venta'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Venta->save($this->request->data)) {
				$this->Session->setFlash(__('The venta has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The venta could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Venta.' . $this->Venta->primaryKey => $id));
			$this->request->data = $this->Venta->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Venta->id = $id;
		if (!$this->Venta->exists()) {
			throw new NotFoundException(__('Invalid venta'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Venta->delete()) {
			$this->Session->setFlash(__('Venta deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Venta was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
