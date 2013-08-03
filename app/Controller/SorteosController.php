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
			if ($this->Sorteo->save($this->request->data)) {
				$this->redirect(array('controller' => 'decimosconsignados', 'action' => 'consignar', 'sorteo_id' => $this->Sorteo->id));
			} else {
				$this->Session->setFlash(__('El sorteo no se pudo guardar. Por favor, inténtelo de nuevo.'));
			}
		}/* else {
			$options = array('conditions' => array('Sorteo.' . $this->Sorteo->primaryKey => $id));
			$this->request->data = $this->Sorteo->find('first', $options);
		}*/
	}
}
