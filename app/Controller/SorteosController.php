<?php
App::uses('AppController', 'Controller');
/**
 * Sorteos Controller
 *
 * @property Sorteo $Sorteo
 */
class SorteosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sorteo->recursive = 0;
		$this->set('sorteos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sorteo->exists($id)) {
			throw new NotFoundException(__('Invalid sorteo'));
		}
		$options = array('conditions' => array('Sorteo.' . $this->Sorteo->primaryKey => $id));
		$this->set('sorteo', $this->Sorteo->find('first', $options));
		
		$this->Sorteo->virtualFields['Decimosconsignados'] = 0;
		$resultado = $this->Sorteo->query("SELECT sum(cantidad) AS Sorteo__Decimosconsignados FROM decimosconsignados WHERE sorteo_id = {$id}");
		$this->set('totalDecimosConsignados', $resultado[0]['Sorteo']['Decimosconsignados']);
		
		$this->Sorteo->virtualFields['Numerosvendidos'] = 0;
		$resultado = $this->Sorteo->query("SELECT sum(cantidad) AS Sorteo__Numerosvendidos FROM numerosvendidos WHERE sorteo_id = {$id}");
		$this->set('totalDecimosVendidos', $resultado[0]['Sorteo']['Numerosvendidos']);
		
		$this->Sorteo->virtualFields['Numerosinvendidos'] = 0;
		$resultado = $this->Sorteo->query("SELECT sum(cantidad) AS Sorteo__Numerosinvendidos FROM numerosinvendidos WHERE sorteo_id = {$id}");
		$this->set('totalDecimosInvendidos', $resultado[0]['Sorteo']['Numerosinvendidos']);
	}
	
	public function get_form($id = null) {
		if (!$this->Sorteo->exists($id)) {
			$this->render('add', 'ajax');
		} else {
			$this->render('edit', 'ajax');
			$options = array('conditions' => array('Sorteo.' . $this->Sorteo->primaryKey => $id));
			$this->set('sorteo', $this->Sorteo->find('first', $options));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sorteo->create();
			if ($this->Sorteo->save($this->request->data)) {
				$this->redirect(array('controller' => 'decimosconsignados', 'action' => 'consignar', 'sorteo_id' => $this->Sorteo->id));
			} else {
				$this->Session->setFlash(__('El sorteo no se pudo guardar. Por favor, inténtelo de nuevo'));
				$this->redirect($this->referer());
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
		if (!$this->Sorteo->exists($id)) {
			throw new NotFoundException(__('Sorteo no válido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data('Sorteo.precio_x_decimo', strtr($this->request->data('Sorteo.precio_x_decimo'), array('.' => '', ',' => '.')));
			if ($this->Sorteo->save($this->request->data)) {
				$this->redirect(array('controller' => 'decimosconsignados', 'action' => 'consignar', 'sorteo_id' => $this->Sorteo->id));
			} else {
				$this->Session->setFlash(__('El sorteo no se pudo guardar. Por favor, inténtelo de nuevo.'));
			}
		} else {
			$options = array('conditions' => array('Sorteo.' . $this->Sorteo->primaryKey => $id));
			$this->request->data = $this->Sorteo->find('first', $options);
		}
	}
}
