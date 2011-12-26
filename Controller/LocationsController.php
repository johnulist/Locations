<?php
class LocationsController extends AppController {

	public $name = 'Locations';
	public $uses = 'Locations.Location';
	public $components = array('RequestHandler');

	function index() {
		$this->Location->recursive = 0;
		$this->set('locations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('location', $this->Location->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Location->create();
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.', true));
			}
		}
		$this->set('model', $this->Location->getModels());
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Location->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for location', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Location->delete($id)) {
			$this->Session->setFlash(__('Location deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Location was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>