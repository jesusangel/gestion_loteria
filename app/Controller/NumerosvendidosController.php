<?php
App::uses('AppController', 'Controller');
/**
 * Numerosvendidos Controller
 *
 * @property Numerosvendido $Numerosvendido
 */
class NumerosvendidosController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Numerosvendido->recursive = 0;
		$this->set('numerosvendidos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Numerosvendido->exists($id)) {
			throw new NotFoundException(__('Invalid numerosvendido'));
		}
		$options = array('conditions' => array('Numerosvendido.' . $this->Numerosvendido->primaryKey => $id));
		$this->set('numerosvendido', $this->Numerosvendido->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Numerosvendido->create();
			if ($this->Numerosvendido->save($this->request->data)) {
				$this->Session->setFlash(__('The numerosvendido has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The numerosvendido could not be saved. Please, try again.'));
			}
		}
		$sorteos = $this->Numerosvendido->Sorteo->find('list');
		$ventas = $this->Numerosvendido->Ventum->find('list');
		$this->set(compact('sorteos', 'ventas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Numerosvendido->exists($id)) {
			throw new NotFoundException(__('Invalid numerosvendido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Numerosvendido->save($this->request->data)) {
				$this->Session->setFlash(__('The numerosvendido has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The numerosvendido could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Numerosvendido.' . $this->Numerosvendido->primaryKey => $id));
			$this->request->data = $this->Numerosvendido->find('first', $options);
		}
		$sorteos = $this->Numerosvendido->Sorteo->find('list');
		$ventas = $this->Numerosvendido->Ventum->find('list');
		$this->set(compact('sorteos', 'ventas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Numerosvendido->id = $id;
		if (!$this->Numerosvendido->exists()) {
			throw new NotFoundException(__('Invalid numerosvendido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Numerosvendido->delete()) {
			$this->Session->setFlash(__('Numerosvendido deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Numerosvendido was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
