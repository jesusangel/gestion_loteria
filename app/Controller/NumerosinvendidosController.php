<?php
App::uses('AppController', 'Controller');
/**
 * Numerosinvendidos Controller
 *
 * @property Numerosinvendido $Numerosinvendido
 */
class NumerosinvendidosController extends AppController {

	public function seleccionar_sorteo() {
		$sorteos = $this->Numerosinvendido->Sorteo->find('list', array(
			'fields' =>  array('id', 'titulo'),
			'conditions' => array('fecha >= NOW()')
		));
		$this->set(compact('sorteos'));
		
		if ($this->request->is('post')) {
			$this->Numerosinvendido->Sorteo->contain();
			
			$codigo = trim($this->request->data('Numerosinvendido.codigo'));
			if ( $codigo != '' ) {
				// Obtenemos el sorteo a partir del código de uno de sus décimos
				try {
					$datos_de_codigo = $this->Numerosinvendido->parseCodigo($codigo);
					
					$options = array('conditions' => array(
						'Sorteo.numero' => $datos_de_codigo['numero_sorteo'],
						'Sorteo.anio' => $datos_de_codigo['anio'])
					);
					
					if ( $sorteo = $this->Numerosinvendido->Sorteo->find('first', $options) ) {
						// El sorteo ya había sido creado
						if ( (strtotime($sorteo['Sorteo']['fecha']) - time()) < 0 ) {
							throw new Exception('El sorteo seleccionado ya ha sido celebrado');
						}
						$this->request->data('Sorteo', $sorteo['Sorteo']);
					} else {
						throw new NotFoundException(__('Sorteo no encontrado'));
					} 
				} catch (Exception $e) {
					$this->request->data('Numerosinvendido.codigo', '');
					$this->Session->setFlash($e->getMessage());
				}
			} else if ( ($sorteo_id = $this->request->data('Numerosinvendido.sorteo_id')) > 0 ) {
				$sorteo = $this->Numerosinvendido->Sorteo->find('first', array('conditions' => array('id' => $sorteo_id)));
				$this->request->data('Sorteo', $sorteo['Sorteo']);
			}
		}
	}
	
	public function set_modo_invender() {
		if ( in_array($this->request->data('Numerosinvendido.modoInvender'), array('individual', 'fraccion', 'billete', 'series')) ) {
			Configure::write('modoInvenderDecimos', $this->request->data('Numerosinvendido.modoInvender'));	// No se mantiene entre peticiones, no sirve de mucho en este caso
			$this->Cookie->write('Numerosinvendidos.modoInvender', $this->request->data('Numerosinvendido.modoInvender'), true, false);
			$this->Session->write('Numerosinvendidos.modoInvender', $this->request->data('Numerosinvendido.modoInvender'));
		} else {
			$this->Session->setFlash(__('Modo de invender incorrecto'));
		}
		$this->redirect($this->referer());
	}
	
	public function invender() {
		// Obtenemos el ID del sorteo de los parámetros recibidos o de la sesión
		if ( $this->request->data('Sorteo.id') ) {
			$sorteo_id = $this->request->data('Sorteo.id');
			$this->Session->write('Numerosinvendidos.sorteo_id', $sorteo_id);
		} else if ( $this->Session->check('Numerosinvendidos.sorteo_id') ) {
			$sorteo_id = $this->Session->read('Numerosinvendidos.sorteo_id');
		} else {
			$sorteo_id = 0;
		}
		
		try {
			if ( $sorteo_id == 0 ) {
				throw new UnexpectedValueException(__('Debe seleccionar el sorteo para el que se invenderán los décimos'));
			}
			$this->Numerosinvendido->Sorteo->contain(false);
			if ( !$sorteo = $this->Numerosinvendido->Sorteo->read(null, $sorteo_id) ) {
				throw new SorteoNoEncontradoException();
			}
			if ( (strtotime($sorteo['Sorteo']['fecha']) - time()) < 0 ) {
				throw new SorteoCelebradoException();
			}
			
			// El modo de invender se fija mediante la accion set_modo_invender
			$modosInvender = array('individual' => 'Individual', 'fraccion' => 'Fraccion', 'billete' => 'Billete', 'series' => 'Series');
			if ( $this->Session->check('Numerosinvendidos.modoInvender') ) {
				$modoInvenderSeleccionado = $this->Session->read('Numerosinvendidos.modoInvender');
			} else if ( $this->Cookie->check('Numerosinvendidos.modoInvender')) {
				$modoInvenderSeleccionado = $this->Cookie->read('Numerosinvendidos.modoInvender');
			} else {
				$modoInvenderSeleccionado = Configure::read('modoInvenderDecimos');
			}
			$this->view = 'invender_' . $modoInvenderSeleccionado;
			
			if ( $this->request->is('post') ) {
				$codigo_o_numero = trim($this->request->data('Numerosinvendido.codigo'));
				switch ( $modoInvenderSeleccionado ) {
					case 'individual':
					break;
					case 'fraccion':
					break;
					case 'billete':
					break;
					case 'series':
						$serie_inicial = (int) $this->request->data('Numerosinvendido.serieInicial');
						$serie_final = (int) $this->request->data('Numerosinvendido.serieFinal');
						$resultado = $this->Numerosinvendido->invender_series($sorteo_id, $codigo_o_numero, $serie_inicial, $serie_final);
						$this->Session->setFlash(__('Invendidos %s números', $resultado));
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
		
		$this->request->data('Numerosinvendido.codigo', '');
		$this->request->data('Numerosinvendido.serieInicial', '');
		$this->request->data('Numerosinvendido.serieFinal', '');
		
		$this->set(compact('sorteo', 'modosInvender', 'modoInvenderSeleccionado'));
		$this->paginate = array(
			'conditions' => array('sorteo_id' => $sorteo['Sorteo']['id']),
			'order' => array('Numerosinvendido.created' => 'DESC')
		);
		$this->set('numerosinvendidos', $this->paginate());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Numerosinvendido->recursive = 0;
		$this->set('numerosinvendidos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Numerosinvendido->exists($id)) {
			throw new NotFoundException(__('Invalid numerosinvendido'));
		}
		$options = array('conditions' => array('Numerosinvendido.' . $this->Numerosinvendido->primaryKey => $id));
		$this->set('numerosinvendido', $this->Numerosinvendido->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Numerosinvendido->create();
			if ($this->Numerosinvendido->save($this->request->data)) {
				$this->Session->setFlash(__('The numerosinvendido has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The numerosinvendido could not be saved. Please, try again.'));
			}
		}
		$sorteos = $this->Numerosinvendido->Sorteo->find('list');
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
		if (!$this->Numerosinvendido->exists($id)) {
			throw new NotFoundException(__('Invalid numerosinvendido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Numerosinvendido->save($this->request->data)) {
				$this->Session->setFlash(__('The numerosinvendido has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The numerosinvendido could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Numerosinvendido.' . $this->Numerosinvendido->primaryKey => $id));
			$this->request->data = $this->Numerosinvendido->find('first', $options);
		}
		$sorteos = $this->Numerosinvendido->Sorteo->find('list');
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
		$this->Numerosinvendido->id = $id;
		if (!$this->Numerosinvendido->exists()) {
			throw new NotFoundException(__('Número no válido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Numerosinvendido->delete()) {
			$this->Session->setFlash(__('Número invendido borrado'));
			$this->redirect(array('action' => 'invender'));
		}
		$this->Session->setFlash(__('El número invendido no se borró'));
		$this->redirect(array('action' => 'invender'));
	}
}
