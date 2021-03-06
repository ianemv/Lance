<?php
class PlazasController extends AppController {

	var $name = 'Plazas'; 
	
	var $paginate = array(
	    'limit' => 12,   
		'order' => ''
    ); 

function beforeFilter(){
    parent::beforeFilter();
    if(isset($this->Auth)){
        $this->Auth->allow('getwinners');
    }
}     
	
    function index() {
		$this->set('title_for_layout', 'Votar por una plaza');
		$this->paginate = array('limit' => 9, 'order' => 'Plaza.vote_count DESC');
		$this->set('plazas', $this->paginate());
    }

	function description($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), __('plaza', true)), 'error');
			$this->redirect(array('action' => 'index'));
		}     
		$this->layout = 'ajax';                                            
		$description = $this->Plaza->read(null, $id);     
		$this->set('plaza', $description);
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
			if ($this->Plaza->saveAll($this->data)) {
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
			if ($this->Plaza->saveAll($this->data)) {
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
        $this->paginate = array('order' => 'Plaza.vote_count DESC');
		return $this->paginate();       
	} 
	
	function getwinners() {
		$plazas = $this->Plaza->find('all', array('conditions' => array('Plaza.id' => array(18, 76))));
		return $plazas;
	}

    function count() {
        $this->layout = "ajax";

    }

}
?>
