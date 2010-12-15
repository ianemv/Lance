<?php
class DonationsController extends AppController {

	var $name = 'Donations'; 
	
    var $helpers = array('Dineromail'); 
	
	function beforeFilter() {
		parent::beforeFilter();
		if (!empty($this->Auth)) {
			$this->Auth->allow('index', 'donate', 'donated', 'canceled', 'grid', 'winner');
		}
	} 

	function index() {   
		$this->set('title_for_layout', __('Necesitamos tu donación, para hacer real su sueño', true));
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
        } else { 
	   		if (Configure::read('dev')) { 
				$this->redirect('winner');
			}
        }
	} 
	
	function winner() {
		$this->set('title_for_layout', __('', true));
		
	}

    function add($meter = null) {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
        } 

  		if (empty($meter)) {
		   // Find available meter and set it.  No free meters up to 1000 get the next in the list.
		}  
		$this->set('meter', $meter);                         
    } 

	function grid() {
		if ($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';
		} else {
	    	$this->redirect('/');
		}
		
		
	}

	function admin_index() {
		$this->Donation->recursive = 0;
		$this->set('donations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid donation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('donation', $this->Donation->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Donation->create();
			if ($this->Donation->save($this->data)) {
				$this->Session->setFlash(__('The donation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The donation could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid donation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Donation->save($this->data)) {
				$this->Session->setFlash(__('The donation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The donation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Donation->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for donation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Donation->delete($id)) {
			$this->Session->setFlash(__('Donation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Donation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function donate() {
        $this->layout = 'ajax';
		$this->autoRender = false; 
		$id = null;
        if (!$this->RequestHandler->isAjax()) {
       		$this->redirect('/');
        }

        if (!empty($this->data)) {  
			if ($this->Session->check('Auth.User')) {
				$id = $this->Auth->User('id');
			}  
      
			if ($donation = $this->Donation->donate($this->data, $id)) {  
				if (empty($donation['valid'])) { 
					// Send Welcome Email to New Register via Donation
					$this->_sendEmail($donation);
				}
			}
		} 
		
		if (!empty($donation['Donation']['id'])) {
			$return = array('valid' => true, 'url' => '/payment_gateways/dineromail/donation/'.$donation['Donation']['id']);
	    } else {
			$return = $donation;
		}
		
		return json_encode($return);
		exit();
    } 

	function dontated() {
		
	}   
	
	function canceled() {
		
	}  
	
}
?>
