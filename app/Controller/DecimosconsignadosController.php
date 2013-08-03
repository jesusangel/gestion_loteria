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
