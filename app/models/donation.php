<?php
class Donation extends AppModel {
	var $name = 'Donation';

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array( 
		'DonationMeter' => array(
		 	'className' => 'DonationMeter',
			'foreignKey' => 'donation_id',
			'dependent' => true,
		)
  	);

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
    } 

    function donate($data, $id =null) {
	    if (!empty($data)) {  

            if (!empty($data['Donation'])) {
	   			$data['Donation']['quantity'] = ($data['Donation']['quantity'])?$data['Donation']['quantity']:$this->appConfigurations['donations']['min'];
               	if ($user = $this->User->register($data, $id)) {
					$data['Donation']['user_id'] = $user['User']['id'];
					$data['Donation']['status_id'] = 1; 
					$data['Donation']['price'] = $this->appConfigurations['donations']['cost']; 
					$data['Donation']['total'] = ($this->appConfigurations['donations']['cost'] * $data['Donation']['quantity']);      
 
					if ($this->save($data)) { 
						$user['Donation']['id'] = $this->id;
						$meterCount = 0;
						if (!empty($data['DonationMeter'])) {
							$meterCount = count($data['DonationMeter']);
						} 
                                                                                         
						$meters = $this->DonationMeter->generateMeter($data['Donation']['quantity'] - $meterCount); 
						for($i=0;$i<$data['Donation']['quantity'];$i++) { 
							$data['DonationMeter'][$i]['donation_id'] = $this->id;
							if (empty($data['DonationMeter'][$i]['meter'])) {
								$data['DonationMeter'][$i]['meter'] = array_shift($meters);
							}
						} 

						$this->DonationMeter->saveAll($data['DonationMeter']);    
					}
                } else {
                    $errors = array();
                    foreach ($this->User->validationErrors as $key=>$error) {
                        $errors[Inflector::camelize("Donation ".$key)] = $error;
                    }
                    $user = array('valid' => false, 'errors' => $errors);  
                }      
                return $user;
            } else {
                return false;
            }
        }
        return false;
    }
}
?>
