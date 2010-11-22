<?php
class PaymentGatewaysController extends AppController{
    var $name = 'PaymentGateways';
    var $uses = array('Donation');
	var $components = array('Cookie');
   

    function beforeFilter(){
        parent::beforeFilter();
        if(isset($this->Auth)){
            $this->Auth->allow('returning','pending','cancel','dineromail', 'dineromail_ipn');
        }
    }

	/**
	 * Function to calculate hmac
	 */
	function _hmac($data, $key){
	   // RFC 2104 HMAC implementation for php.
	   // Creates an md5 HMAC.
	   // Eliminates the need to install mhash to compute a HMAC
	   // Hacked by Lance Rushing
	   $b = 64; // byte length for md5
	   if (strlen($key) > $b) {
		   $key = pack("H*",md5($key));
	   }
	   $key  = str_pad($key, $b, chr(0x00));
	   $ipad = str_pad('', $b, chr(0x36));
	   $opad = str_pad('', $b, chr(0x5c));
	   $k_ipad = $key ^ $ipad ;
	   $k_opad = $key ^ $opad;

	   return md5($k_opad  . pack("H*",md5($k_ipad . $data)));
	}



	/**
	 * Function for returning from payment gateways
	 */
	function returning($model = null) {    
		if (!empty($model)) {
			switch($model) {
				case 'donation':  
					$this->Session->setFlash(__('', true));
					$this->redirect(array('controller' => 'donations', 'action' => 'dontated'));
					break;
			}
		} else {
			die('Made it here');
		}                 
	}

	/**
	 * Function for cancelling from payment gateway
	 */
	function cancel($model){
		if(!empty($model)){
			switch($model){
				case 'donation':
					$this->Session->setFlash(__('Your donation payment was canceled.', true));
					$this->redirect(array('controller' => 'donations', 'action' => 'canceled'));
					break;
			}
		}else{
			die('I hate you');
		}
	}  
	  
	function _getDonation($donation_id, $user_id, $redirect = true) {
		$donation = $this->Donation->find('first', array('conditions' => array('Donation.id' => $donation_id)));
		
		if (!empty($donation)) {
			if ($donation['Donation']['user_id'] != $user_id) {
				$this->Session->setFlash(__('Invalid Action', true));
				$this->redirect(array('controller' => 'donations', 'action' => 'donated'));
			}                                                                              
			
			if ($donation['Donation']['status_id'] != 1) {
				if ($redirect) {
					$this->Session->setFlash(__('You have already paid for this donation.', true));
					$this->redirect(array('controller' => 'donations', 'action' => 'donated'));
				}                                                                              
			}                                                                                  
	 		$total = "total";
			$donation['Donation']['total'] = $total;
		}                                           
		return $donation;
	}
	
	function _setDonationStatus($donation_id, $status_id) {
		if (!empty($donation_id) && !empty($status_id)) {
			$donation['Donation']['id']			= $donation_id;
			$donation['Donation']['status_id']	= $status_id;
			
			return $this->Donation->save($donation, false);
		} else {
			return false;
		}
	}

    /**
     * Function for sending notification after donation payment
     */
    function _sendDonationNotification($donation, $user_id = null){
        // Get users
        $user = $this->User->findById($user_id);

        $data['template'] = 'payment_gateways/donation_pay';
        $data['layout']   = 'default';

        // Send to both user and admin
        $data['to'] 	  = array($user['User']['email'], $this->appConfigurations['email']);

        $data['subject']  = __('Donation Payment', true);
        $data['User']	  = $user['User'];

        $this->set('data', $data);
        $this->set('donation', $donation);

        if($this->_sendEmail($data)){
            return true;
        }else{
            return false;
        }
    }

    /* Returns true if a given variable represents an associative array */
    function is_associative_array( $var ) {
        return is_array( $var ) && !is_numeric( implode( '', array_keys( $var ) ) );
    } 

 


    /**
     * DineroMail payment gateway
     * http://www.dineromail.com
     */
    function dineromail($model = null, $id = null){
		$gateway = Configure::read('PaymentGateways.Dineromail') ? Configure::read('PaymentGateways.Dineromail') : Configure::read('Dineromail'); 
		$dineroMail  = array();

		if(!empty($model)){ 
			
			$dineroMail['error_url'] 	= Configure::read('App.url') . '/users';
			$dineroMail['ok_url']    	= Configure::read('App.url') . '/payment_gateways/returning/donation'; 
			$dineroMail['pending_url']  = Configure::read('App.url') . '/payment_gateways/pending/donation';
			$dineroMail['country_id'] 	= $gateway['country_id'];
			$dineroMail['url'] 	  	    = $gateway['url'];
			$dineroMail['merchant'] 	= $gateway['merchant'];  
			$dineroMail['payment_method_available'] = $gateway['payment_method_available'];
			$dineroMail['header_image'] = Configure::read('App.url') . '/img/logo.png'; 
			$dineroMail['custom']		 = $model . '#' . $id . '#' . $this->Auth->user('id');

			switch($model){
                case 'donation':
					// Formating the data
					$dineroMail['item_name_1']   = Configure::read('App.name') . " - " .  __('Donación', true);
					$dineroMail['item_quantity_1'] = 1;
					$dineroMail['item_ammount_1'] = 100000.00;
					$dineroMail['change_quantity'] = 1;
                    break;
                default:
                    $this->Session->setFlash(sprintf(__('There is no handler for %s in this payment gateway.', true), $model));
                    $this->redirect('/');
            }    

			$this->set('dineroMailData', $dineroMail);
		}else{
			$this->Session->setFlash(__('Invalid payment gateway', true));
		}
    }


	function dineromail_ipn(){
		$gateway = Configure::read('PaymentGateways.Dineromail') ? Configure::read('PaymentGateways.Dineromail') : Configure::read('Dineromail');  

 /*   	$this->Dineromail->configure($gateway);
    	if($this->Dineromail->validate_ipn()) {

			if(strtolower($this->Paypal->ipn_data['payment_status']) == 'completed'){
				// Read the info
				$control = explode('#', $this->Paypal->ipn_data['custom']);

				$model         = !empty($control[0]) ? $control[0] : null;
				$id            = !empty($control[1]) ? $control[1] : null;
				$user_id       = !empty($control[2]) ? $control[2] : null;

				switch($model){
					case 'donation':
						$donation = $this->_getDonation($id, $user_id, false);

						// Change donation status
						$status = $this->_setDonationStatus($id, 2);

                        // Send notification email
                        $this->_sendDonationNotification($donation, $user_id);
						break;
				}
			}
		}else{
			$this->log('ipn validation failed.');
		} 
		*/
    }

 
}
?>
