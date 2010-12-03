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
	
	
	function generateMeter($num) {
		return rand(1,1000);
	}
}
?>