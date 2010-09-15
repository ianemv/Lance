<?php
class SponcersController extends AppController {

	var $name = 'Sponcers';

	function admin_index() {
		$this->Sponcer->recursive = 0;
		$this->set('sponcers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'sponcer'), 'admin/attention');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sponcer', $this->Sponcer->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Sponcer->create();
			if ($this->Sponcer->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'sponcer'), 'admin/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'sponcer'), 'admin/error');
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'sponcer'), 'admin/attention');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sponcer->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'sponcer'), 'admin/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'sponcer'), 'admin/error');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sponcer->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'sponcer'), 'admin/attention');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sponcer->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Sponcer'), 'admin/success');
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Sponcer'), 'admin/error');
		$this->redirect(array('action' => 'index'));
	} 
	
	function getsponcers() {
		return $this->Sponcer->find('all', array('order' => array('Sponcer.show_order ASC')));
	}

}
?>