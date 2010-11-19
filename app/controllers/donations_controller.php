<?php
class DonationsController extends AppController {

	var $name = 'Donations'; 
	
    var $helpers = array('Dineromail'); 
	
	function beforeFilter() {
		parent::beforeFilter();
		if (!empty($this->Auth)) {
			$this->Auth->allow('index', 'donate');
		}
	} 

	function index() {   
		$this->set('title_for_layout', __('Necesitamos tu donación, para hacer real su sueño', true));
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
        } else {
		    #$this->Donation->recursive = 0;
		    #$this->set('donations', $this->paginate());
        }
	}

    function add() {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
        }   

	   	if(in_array($this->RequestHandler->getClientIp(), $this->appConfigurations['allowedIps'])) { 
			$this->set('test', true);
		} else {       
			#echo $this->RequestHandler->getClientIp();
			$this->set('test', false);
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
					#$this->_sendEmail($donation);
				}
			}
		}
    	
		return json_encode(array('valid' => true, 'url' => '/payment_gateways/dineromail/donation/'.$donation['Donation']['id']));
		exit();
    }
}
?>
