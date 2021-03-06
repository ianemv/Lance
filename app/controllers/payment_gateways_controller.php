<?php
class PaymentGatewaysController extends AppController{
    var $name = 'PaymentGateways';
    var $uses = array('Donation');
	var $components = array('Cookie', 'Dineromail');
   

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
	  
	function _getDonation($donation_id, $redirect = false) {
		$donation = $this->Donation->find('first', array('conditions' => array('Donation.id' => $donation_id)));
		
		if (!empty($donation)) {
		   # if ($donation['Donation']['user_id'] != $user_id) {
		   # 	$this->Session->setFlash(__('Invalid Action', true));
		   # 	$this->redirect(array('controller' => 'donations', 'action' => 'donated'));
		   # }                                                                              
			
			if ($donation['Donation']['status_id'] != 1) {
				if ($redirect) {
					$this->Session->setFlash(__('You have already paid for this donation.', true));
					$this->redirect(array('controller' => 'donations', 'action' => 'donated'));
				} 
				return false;                                                                             
			}                                                                                  
		}                                           
		return $donation;
	}
	
	function _setDonationStatus($donation_id, $status_id, $data = array()) {
		if (!empty($donation_id) && !empty($status_id)) {
			$donation['Donation']['id']			= $donation_id;
			$donation['Donation']['status_id']	= $status_id; 
			$donation['Donation']['data'] 		= json_encode($data);

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
        $data['to'] 	  = $user['User']['email'];

        $data['subject']  = __('Donación', true) . ' - '. Configure::read('App.name');
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
			
			$dineroMail['error_url'] 	= Configure::read('App.url');
			$dineroMail['ok_url']    	= Configure::read('App.url') . 'payment_gateways/returning/donation'; 
			$dineroMail['pending_url']  = Configure::read('App.url') . 'payment_gateways/pending/donation';
			$dineroMail['transaction_id'] = $id;
			$dineroMail['custom']		 = $model . '#' . $id . '#' . $this->Auth->user('id');
			 
			if (is_array($gateway)) {
				foreach ($gateway as $key => $value) {
					$dineroMail[$key] = $value;
				}
			}

			switch($model){
                case 'donation':
					$donations = $this->_getDonation($id, false);
					// Formating the data
					$dineroMail['item_name_1']   = Configure::read('App.name') . " - " .  __('Donación', true);
					$dineroMail['item_quantity_1'] = $donations['Donation']['quantity'];
					$dineroMail['item_ammount_1'] = $donations['Donation']['price'];
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
   		  
		$this->Dineromail->configure($gateway);
    	if($this->Dineromail->validate_ipn()) {    
	 	  	foreach ($this->Dineromail->ipn_data['OPERACIONES']['OPERACION'] as $key => $operacion) {  
				$model = 'donation';
				$id = $operacion['ID'];
				switch($model) {
					case 'donation':      
						// Get Donation
						$donation = $this->_getDonation($id); 
                        
						if ($donation !== false) {
							// Change donation status       
							$status = $this->_setDonationStatus($id, $operacion['ESTADO'], $operacion);
						
							if ($operacion['ESTADO'] == 2) {
								// Send notification email
	                        	$this->_sendDonationNotification($donation, $donation['Donation']['user_id']);  
						   	}  
						}
					break;
				}
			}
		}else{
			$this->log('ipn validation failed.');
		} 
    }

 
}
?>
