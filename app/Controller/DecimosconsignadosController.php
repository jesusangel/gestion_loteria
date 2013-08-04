<?php
App::uses('AppController', 'Controller');
/**
 * Decimosconsignados Controller
 *
 * @property Decimosconsignado $Decimosconsignado
 */
class DecimosconsignadosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Decimosconsignado->recursive = 0;
		$this->set('decimosconsignados', $this->paginate());
	}
	
	public function seleccionar_sorteo() {
		$sorteos = $this->Decimosconsignado->Sorteo->find('list', array(
			'fields' =>  array('id', 'titulo'),
			'conditions' => array('fecha >= NOW()')
		));
		$this->set(compact('sorteos'));
		
		if ($this->request->is('post')) {
			$this->Decimosconsignado->Sorteo->contain();
			
			$codigo = trim($this->request->data('Decimosconsignado.codigo'));
			if ( $codigo != '' ) {
				// Obtenemos el sorteo a partir del código de uno de sus décimos
				try {
					$datos_de_codigo = $this->Decimosconsignado->parseCodigo($codigo);
					
					$options = array('conditions' => array(
						'Sorteo.numero' => $datos_de_codigo['numero_sorteo'],
						'Sorteo.anio' => $datos_de_codigo['anio'])
					);
					
					if ( $sorteo = $this->Decimosconsignado->Sorteo->find('first', $options) ) {
						// El sorteo ya había sido creado
						if ( (strtotime($sorteo['Sorteo']['fecha']) - time()) < 0 ) {
							throw new Exception('El sorteo seleccionado ya ha sido celebrado');
						}
						$this->request->data('Sorteo', $sorteo['Sorteo']);
					} else {
						if ( (strtotime($datos_de_codigo['fecha_sorteo']) - time()) < 0 ) {
							throw new Exception('El sorteo seleccionado ya ha sido celebrado');
						}
						$this->request
							->data('Sorteo.numero', $datos_de_codigo['numero_sorteo'])
							->data('Sorteo.anio', $datos_de_codigo['anio'])
							->data('Sorteo.precio_x_decimo', $datos_de_codigo['precio_x_decimo'])
							->data('Sorteo.fecha', $datos_de_codigo['fecha_sorteo']);
					} 
			
				} catch (Exception $e) {
					$this->Session->setFlash($e->getMessage());
				}
			} else if ( ($sorteo_id = $this->request->data('Decimosconsignado.sorteo_id')) > 0 ) {
				$sorteo = $this->Decimosconsignado->Sorteo->find('first', array('conditions' => array('id' => $sorteo_id)));
				$this->request->data('Sorteo', $sorteo['Sorteo']);
			}
		}
	}
	
	public function set_modo_consignacion() {
		if ( in_array($this->request->data('Decimosconsignado.modoConsignacion'), array('individual', 'fraccion', 'billete', 'series')) ) {
			Configure::write('modoConsignacionDecimos', $this->request->data('Decimosconsignado.modoConsignacion'));	// No se mantiene entre peticiones, no sirve de mucho en este caso
			$this->Cookie->write('Decimosconsignados.modoConsignacion', $this->request->data('Decimosconsignado.modoConsignacion'), true, false);
			$this->Session->write('Decimosconsignados.modoConsignacion', $this->request->data('Decimosconsignado.modoConsignacion'));
		} else {
			$this->Session->setFlash(__('Modo de consignación incorrecto'));
		}
		$this->redirect($this->referer());
	}
	
	public function consignar() {
		// Obtenemos el ID del sorteo de los parámetros recibidos o de la sesión
		if ( isset($this->request->named['sorteo_id']) ) {
			$sorteo_id = $this->request->named['sorteo_id'];
			$this->Session->write('Decimosconsignados.sorteo_id', $sorteo_id);
		} else if ( $this->Session->check('Decimosconsignados.sorteo_id') ) {
			$sorteo_id = $this->Session->read('Decimosconsignados.sorteo_id');
		} else {
			$sorteo_id = 0;
		}
		
		try {
			if ( $sorteo_id == 0 ) {
				throw new UnexpectedValueException(__('Debe seleccionar el sorteo para el que se consignarán los décimos'));
			}
			$this->Decimosconsignado->Sorteo->contain(false);
			if ( !$sorteo = $this->Decimosconsignado->Sorteo->read(null, $sorteo_id) ) {
				throw new SorteoNoEncontradoException();
			}
			if ( (strtotime($sorteo['Sorteo']['fecha']) - time()) < 0 ) {
				throw new SorteoCelebradoException();
			}
			
			// El modo de consignación se fija mediante la accion set_modo_consignacion
			$modosConsignacion = array('individual' => 'Individual', 'fraccion' => 'Fraccion', 'billete' => 'Billete', 'series' => 'Series');
			if ( $this->Session->check('Decimosconsignados.modoConsignacion') ) {
				$modoConsignacionSeleccionado = $this->Session->read('Decimosconsignados.modoConsignacion');
			} else if ( $this->Cookie->check('Decimosconsignados.modoConsignacion')) {
				$modoConsignacionSeleccionado = $this->Cookie->read('Decimosconsignados.modoConsignacion');
			} else {
				$modoConsignacionSeleccionado = Configure::read('modoConsignacionDecimos');
			}
			$this->view = 'consignar_' . $modoConsignacionSeleccionado;
			
			if ( $this->request->is('post') ) {
				$codigo_o_numero = trim($this->request->data('Decimosconsignado.codigo'));
				switch ( $modoConsignacionSeleccionado ) {
					case 'individual':
					break;
					case 'fraccion':
					break;
					case 'billete':
					break;
					case 'series':
						$serie_inicial = (int) $this->request->data('Decimosconsignado.serieInicial');
						$serie_final = (int) $this->request->data('Decimosconsignado.serieFinal');
						$resultado = $this->Decimosconsignado->consignar_series($sorteo_id, $codigo_o_numero, $serie_inicial, $serie_final);
						$this->Session->setFlash(__("Importados {$resultado['consignados']} décimos, duplicados {$resultado['duplicados']}, con errores: " . count($resultado['errores'])));
					break;
				}
			}
		} catch ( DecimoAjenoException $e ) {
			$this->Session->setFlash($e->getMessage());
		} catch ( UnexpectedValueException $e ) {
			$this->Session->setFlash($e->getMessage());
		} catch (SorteoNoEncontradoException $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'seleccionar_sorteo'));
		} catch (SorteoCelebradoException $e) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'seleccionar_sorteo'));
		}
		
		$this->set(compact('sorteo', 'modosConsignacion', 'modoConsignacionSeleccionado'));
		$this->set('decimosconsignados', $this->paginate(array('sorteo_id' => $sorteo['Sorteo']['id'])));
	}
	
	public function consignar_series() {
		try {
			if ( !$this->request->data('Decimosconsignado.sorteo_id') ) {
				throw new UnexpectedValueException(__('Debe seleccionar el sorteo para el que se consignarán los décimos'));
			}
			$opciones_sorteo = array(
				'conditions' => array('Sorteo.id' => $this->request->data('Decimosconsignado.sorteo_id')),
				'contain' => false
			);
			if ( !$sorteo = $this->Decimosconsignado->Sorteo->find('first', $opciones_sorteo) ) {
				throw new NotFoundException(__('Sorteo no válido'));
			}
			if ( (strtotime($sorteo['Sorteo']['fecha']) - time()) < 0 ) {
				throw new Exception(__('El sorteo ya se ha celebrado'));
			}
		} catch ( Exception $e ) {
			$this->Session->setFlash($e->getMessage());
			$this->redirect(array('action' => 'seleccionar_sorteo'));
		}
		
		try {
			$codigo_o_numero = trim($this->request->data('Decimosconsignado.codigo'));
			if ( strlen($codigo_o_numero) == Configure::read('longitudCodigoDecimo') ) {
				$datos_de_codigo = $this->Decimosconsignado->parseCodigo($codigo_o_numero);
				
				if ( $datos_de_codigo['numero_sorteo'] != $sorteo['Sorteo']['numero'] || $datos_de_codigo['anio'] != $sorteo['Sorteo']['anio'] ) {
					throw new UnexpectedValueException(__('El décimo escaneado no pertenece a este sorteo'));
				}
				
				$numero = (int) $datos_de_codigo['numero'];
			} else {
				if ( $codigo_o_numero <= 0 || $codigo_o_numero > Configure::read('numeroMaximo') ) {
					throw new UnexpectedValueException(__('El número introducido no está dentro de los márgenes admitidos: 0 - ' . Configure::read('numeroMaximo')));
				}
				$numero = (int) $codigo_o_numero; 
			}
			
			$serie_inicial = (int) $this->request->data('Decimosconsignado.serieInicial');
			if ( $serie_inicial <= 0 || $serie_inicial > Configure::read('serieMaxima') ) {
				throw new UnexpectedValueException(__('La serie inicial no está dentro de los márgenes admitidos: 1 - ' . Configure::read('serieMaxima')));
			}
			
			$serie_final = (int) $this->request->data('Decimosconsignado.serieFinal');
			if ( $serie_final <= 0 || $serie_final > Configure::read('serieMaxima') ) {
				throw new UnexpectedValueException(__('La serie final no está dentro de los márgenes admitidos: 1 - ' . Configure::read('serieMaxima')));
			}
			
			$errores = array();
			$consignados = 0;
			
			for ( $serie = $serie_inicial; $serie <= $serie_final; $serie++ ) {
				for ( $fraccion = 1; $fraccion <= 10; $fraccion++ ) {
					try {
						$this->Decimosconsignado->create();
						$this->Decimosconsignado->save(array(
							'Decimosconsignado' => array(
								'numero' => $numero,
								'serie' => $serie,
								'fraccion' => $fraccion,
								'sorteo_id' => $sorteo['Sorteo']['id']
							)
						));
						$consignados++;
					} catch( Exception $e ) {
						$errores[] = "Error al consignar el décimo número, {$numero}, serie {$serie}, fraccion {$fraccion}: " . $e->getMessage();
					}
				}
			}
		} catch ( UnexpectedValueException $e ) {
			$this->Session->setFlash($e->getMessage());
		} 

		$this->Session->setFlash(__("Consignados {$consignados} décimos"));
		$this->redirect(array('action' => 'consignar'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Decimosconsignado->exists($id)) {
			throw new NotFoundException(__('Invalid decimosconsignado'));
		}
		$options = array('conditions' => array('Decimosconsignado.' . $this->Decimosconsignado->primaryKey => $id));
		$this->set('decimosconsignado', $this->Decimosconsignado->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Decimosconsignado->create();
			if ($this->Decimosconsignado->save($this->request->data)) {
				$this->Session->setFlash(__('The decimosconsignado has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The decimosconsignado could not be saved. Please, try again.'));
			}
		}
		$sorteos = $this->Decimosconsignado->Sorteo->find('list');
		$this->set(compact('sorteos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Decimosconsignado->exists($id)) {
			throw new NotFoundException(__('Invalid decimosconsignado'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Decimosconsignado->save($this->request->data)) {
				$this->Session->setFlash(__('The decimosconsignado has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The decimosconsignado could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Decimosconsignado.' . $this->Decimosconsignado->primaryKey => $id));
			$this->request->data = $this->Decimosconsignado->find('first', $options);
		}
		$sorteos = $this->Decimosconsignado->Sorteo->find('list');
		$this->set(compact('sorteos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Decimosconsignado->id = $id;
		if (!$this->Decimosconsignado->exists()) {
			throw new NotFoundException(__('Invalid decimosconsignado'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Decimosconsignado->delete()) {
			$this->Session->setFlash(__('Decimosconsignado deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Decimosconsignado was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
