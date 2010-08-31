<?php
class Donation extends AppModel {
	var $name = 'Donation';

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
        ); 
    } 

    function donate($data) {
		 if (is_array($data)) {
	     	if (!empty($data['Donation'])) {
                #$donation = $this->find('first', array('conditions' => $conditions));

                if (!empty($data['Donation'])) {

                    #$user['User']['key']             = Security::hash(uniqid(rand(), true));
                    #$user['User']['before_password'] = substr(sha1(uniqid(rand(), true)), 0, $newPasswordLength);
                    #$user['to']                      = $user['User']['email'];
                    #$user['subject']                 = sprintf(__('Account Reset - %s', true), $this->appConfigurations['name']);
                    #$user['template']                = 'users/reset';
                    #$user['User']['password']        = Security::hash(Configure::read('Security.salt').$user['User']['before_password']);
                    #$user['User']['reset_link']      = $this->appConfigurations['url'].'/users/reset/'. $user['User']['key'];

                    $this->save($data, false);
                    return $data;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
?>