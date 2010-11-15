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

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->validate = array(
            'first_name' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __('Please enter a first name', true),
                ),
            ),
            'last_name' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __('Please enter a last name', true),
                ),
            ),
            'email' => array(
                'email' => array(
                    'rule' => array('email'),
                    'message' => __('Please enter a valid email address', true),
                ),
            ),
            /*'rut' => array(
                'checkRut' => array(
                    'rule' => 'checkRut',
                    'message' => __('Please enter your RUT', true),
                )
            ) */
        ); 
    } 

    function donate($data) {
	    if (!empty($data)) {
            if (!empty($data['Donation'])) {
                $user['User']['group_id']       	= 2;  // Adding User
                $user['User']['username']       	= $data['Donation']['email'];
                $user['Account']['first_name']     	= $data['Donation']['first_name'];
                $user['Account']['last_name']      	= $data['Donation']['last_name'];
                $user['User']['email']          	= $data['Donation']['email'];
                $user['User']['password_before'] 	= $this->User->generateRandomPassword();
                $user['User']['active']         	= 0;
				$donation['Donation']['amount'] 	= $data['Donation']['amount'];
 
               	if ($data = $this->User->register($user)) { 
					$donation['Donation']['user_id'] = $data['User']['id'];
					$donation['Donation']['status_id'] = 1;
					$this->save($donation);
                } else {
                    $errors = array();
                    foreach ($this->User->validationErrors as $key=>$error) {
                        $errors[Inflector::camelize("Donation ".$key)] = $error;
                    }
                    $data = array('valid' => false, 'errors' => $errors);  
                }      
                return $data;
            } else {
                return false;
            }
        }
        return false;
    }
}
?>
