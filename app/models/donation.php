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
            'rut' => array(
                'checkRut' => array(
                    'rule' => 'checkRut',
                    'message' => __('Please enter your RUT', true),
                )
            ) 
        ); 
    } 

    function donate($data) {
	    if (!empty($data)) {
            if (!empty($data['Donation'])) {
                $user['User']['group_id']       = 2;  // Adding User
                $user['User']['username']       = $data['Donation']['email'];
                $user['User']['first_name']     = $data['Donation']['first_name'];
                $user['User']['last_name']      = $data['Donation']['last_name'];
                $user['User']['email']          = $data['Donation']['email'];
                $user['User']['password']       = $this->User->generateRandomPassword();
                $user['User']['active']         = 0;
                $user['User']['rut']            = $data['Donation']['rut'];
                $user['User']['twitter']        = $data['Donation']['twitter'];

                $userInfo = $this->User->findByEmail($user['User']['email']);
                #if (!empty($userInfo)) {
                    if ($data = $this->User->register($user)) {
                        #$user['User']['before_password'] = substr(sha1(uniqid(rand(), true)), 0, $newPasswordLength);
                        #$user['to']                      = $user['User']['email'];
                        #$user['subject']                 = sprintf(__('Account Reset - %s', true), $this->appConfigurations['name']);
                        #$user['template']                = 'users/reset';
                        #$user['User']['password']        = Security::hash(Configure::read('Security.salt').$user['User']['before_password']);
                        #$user['User']['reset_link']      = $this->appConfigurations['url'].'/users/reset/'. $user['User']['key'];
                    } else {
                        $errors = array();
                        foreach ($this->User->validationErrors as $key=>$error) {
                            $errors[Inflector::camelize("Donation ".$key)] = $error;
                        }
                        $data = array('errors' => $errors);  
                    }
                #} else {
                #    $data = array('error' => __('Your Account is created already', true));
                #}
                return $data;
            } else {
                return false;
            }
        }
        return false;
    }
}
?>