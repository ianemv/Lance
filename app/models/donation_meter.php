<?php
class DonationMeter extends AppModel {
	var $name = 'DonationMeter';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Donation' => array(
			'className' => 'Donation',
			'foreignKey' => 'donation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	); 
	
	
	function getCurrentMeters() {
		$query = array(
	   		'fields' => array('DonationMeter.meter'),
	    	'conditions' => array('Donations.status_id' => 1),
			'joins' => array(
				array(
					'table' => 'Donations',
					'alias' => 'Donations',
					'type' => 'LEFT',
					'conditions' => array('Donations.id = DonationMeter.donation_id')
		    	)
		   	)
	   	);
		return $this->find('list', $query);
	}
	
	
	function generateMeter($num = 1) {      
		$totalMeters = range(1, $this->appConfigurations['donations']['meters']);
   		$currentMeters = $this->getCurrentMeters();
		$availableMeters = array_diff($totalMeters, $currentMeters); 
		$availableMeters = (count($availableMeters)>0)?$availableMeters:$totalMeters;  
		$keys =  array_rand($availableMeters, ($num>count($availableMeters))?count($availableMeters):$num); 
		if (is_array($keys)) {
			foreach ($keys as $key) {
				$meters[] = $availableMeters[$key];
			}
		} else {
			$meters[] = $availableMeters[$keys];
		}       
		shuffle($meters);  
		return $meters;
	}  
}
?>