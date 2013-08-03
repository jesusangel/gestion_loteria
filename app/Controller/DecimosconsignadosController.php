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
				try {
					$datos_de_codigo = $this->Decimosconsignado->parseCodigo($codigo);
					
					$options = array('conditions' => array(
						'Sorteo.numero' => $datos_de_codigo['numero_sorteo'],
						'Sorteo.anio' => $datos_de_codigo['anio'])
					);
					if ( $sorteo = $this->Decimosconsignado->Sorteo->find('first', $options) ) {
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
	
	public function consignar() {
		$this->Decimosconsignado->Sorteo->contain(false);
		if ( !$sorteo = $this->Decimosconsignado->Sorteo->find('first', $this->request->named['sorteo_id']) ) {
			throw new NotFoundException(__('Sorteo no válido'));
		}
		if ( (strtotime($sorteo['Sorteo']['fecha']) - time()) < 0 ) {
			throw new Exception(__('El sorteo ya se ha celebrado'));
		}
		$modosConsignacion = array('individual' => 'individual', 'fraccion' => 'fraccion', 'billete' => 'billete', 'series' => 'series');
		$modoConsignacionSeleccionado = 'series';
		
		$this->set(compact('sorteo', 'modosConsignacion', 'modoConsignacionSeleccionado'));
		$this->set('decimosconsignados', $this->paginate(array('sorteo_id' => $sorteo['Sorteo']['id'])));
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
