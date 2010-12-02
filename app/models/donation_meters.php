<?php
class DonationMeter extends AppModel {
	var $name = 'DonationMeter';

	var $belongsTo = array(
		'Donation' => array(
			'className' => 'Donation',
			'foreignKey' => 'donation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	); 
	
	
	function getMeters($num) {
		
	}

}
?>
