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
            /*'rut' => array(
                'checkRut' => array(
                    'rule' => 'checkRut',
                    'message' => __('Please enter your RUT', true),
                )
            ) */
        ); 
    } 

    function donate($data, $id =null) {
	    if (!empty($data)) {  

            if (!empty($data['Donation'])) {   
               	if ($user = $this->User->register($data, $id)) {   
					$data['Donation']['user_id'] = $user['User']['id'];
					$data['Donation']['status_id'] = 1;
					$this->save($data);
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
