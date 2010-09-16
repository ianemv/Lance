<?php
class PlazasController extends AppController {

	var $name = 'Plazas';  
	
    function index() {

    }

	function admin_index() {
		$this->Plaza->recursive = 0;
		$this->set('plazas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'plaza'), 'admin/attention');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('plaza', $this->Plaza->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Plaza->create();
			if ($this->Plaza->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'plaza'), 'admin/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'plaza'), 'admin/error');
			}
		}
		$schools = $this->Plaza->School->find('list');
		$this->set(compact('schools'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'plaza'), 'admin/attention');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Plaza->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'plaza'), 'admin/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'plaza'), 'admin/error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Plaza->read(null, $id);
		}
		$schools = $this->Plaza->School->find('list');
		$this->set(compact('schools'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'plaza'), 'admin/attention');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Plaza->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Plaza'), 'admin/success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Plaza'), 'admin/error');
		$this->redirect(array('action' => 'index'));
	}  
	
	function getplazas() {       
   		return $this->Plaza->find('all', array('limit' => 6));  
	}

}
?>
