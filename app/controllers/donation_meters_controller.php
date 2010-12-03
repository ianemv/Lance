<?php
class DonationMetersController extends AppController {

	var $name = 'DonationMeters'; 
	
	function beforeFilter() {
		parent::beforeFilter();
		if (!empty($this->Auth)) {
			$this->Auth->allow('meters', 'meter');
		}
	}
	
	function meter($meter = null) {  
		$this->DonationMeter->recursive = 2;
		$donationMeter = $this->DonationMeter->findByMeter($meter);
		if (!empty($donationMeter)) {
			$this->layout = 'ajax';
			
		
		} else {
			$this->redirect(array('controller' => 'donations', 'action' => 'add', $meter));
		}
	}
	
	
	function meters() {
        if (!$this->RequestHandler->isAjax()) {
       		$this->redirect('/');
        }
		$this->layout = 'ajax';
		$this->autoRender = false;
		return json_encode($this->DonationMeter->getCurrentMeters());
	}

}
?>