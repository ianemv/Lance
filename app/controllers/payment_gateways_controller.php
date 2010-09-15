<?php
class PaymentGatewaysController extends AppController{
    var $name = 'PaymentGateways';
    var $uses = array();
	var $components = array('Cookie');
   

    function beforeFilter(){
        parent::beforeFilter();
        if(isset($this->Auth)){
            $this->Auth->allow('returning','cancel','dineromail');
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
	 * Function for returning from payment gateway
	 */
	function returning($model){
		if(!empty($model)){
			switch($model){
				case 'auction':
					$this->Session->setFlash(__('Your payment was successful.  We will notify you when your item has been shipped.', true));
					#$this->redirect(array('controller' => 'auctions', 'action' => 'won'));
					break;

				case 'package':
					$this->Session->setFlash(__('You payment was successful and your bids are available for you use.  If your bids are not available yet, please allow a couple of minutes for them to become available.', true), 'default', array('class'=>'success'));
					#$this->redirect(array('controller' => 'accounts', 'action' => 'index'));
					break;
			}
		}else{
			die('Dead');
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
					$this->redirect(array('controller' => 'auctions', 'action' => 'won'));
					break;

				case 'package':
					$this->Session->setFlash(__('Your payment was canceled.', true));
					$this->redirect(array('controller' => 'accounts', 'action' => 'index'));
					break;
			}
		}else{
			die('I hate you');
		}
	}

    /**
     * Function for sending notification after donation payment
     */
    function _sendDonationNotification($donation, $user_id = null){
        // Get users
        $user = $this->User->findById($user_id);

        $data['template'] = 'payment_gateways/auction_pay';
        $data['layout']   = 'default';

        // Send to both user and admin
        $data['to'] 	  = array($user['User']['email'], $this->appConfigurations['email']);

        $data['subject']  = __('Donation Payment', true);
        $data['User']	  = $user['User'];

        $this->set('data', $data);
        $this->set('auction', $auction);

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
			$dineroMail['DireccionFracaso'] = Configure::read('App.url') . '/users';
			$dineroMail['DireccionExito']    = Configure::read('App.url') . '/payment_gateways/returning/donation';
			$dineroMail['url'] 	  	     = $gateway['url'];
			$dineroMail['E_Comercio']      = $gateway['id'];
			#$dineroMail['lc'] 	 	     = $gateway['lc'];
			$dineroMail['MediosPago'] 	= $gateway['medios'];
			$dineroMail['custom']		 = $model . '#' . $id . '#' . $this->Auth->user('id');

			switch($model){
                case 'donation':
                    #$donation   = $this->_getAuction($id, $this->Auth->user('id'));
                    #$addresses = $this->_isAddressCompleted();
                    #$user      = $auction['Winner'];

					// Formating the data
				    $dineroMail['return'] 	     = Configure::read('App.url') . '/payment_gateways/returning/donation';
					$dineroMail['NombreItem']   = "Donar regalaunaplaza.cl";
					$dineroMail['TipoMoneda'] 	= 1;
					$dineroMail['PrecioItem']  	= 1000.00;
				/*	$dineroMail['first_name']  	= $this->Auth->user('first_name');
					$dineroMail['last_name']  	= $this->Auth->user('last_name');
					$dineroMail['email']       	= $this->Auth->user('email');
					$dineroMail['address1']    	= $addresses['Billing']['address_1'];
					$dineroMail['address2']    	= $addresses['Billing']['address_2'];
					$dineroMail['city']    	   	= $addresses['Billing']['city'];
					$dineroMail['zip']    	   	= $addresses['Billing']['postcode']; 
					*/

                    break;
                default:
                    $this->Session->setFlash(sprintf(__('There is no handler for %s in this payment gateway.', true), $model));
                    $this->redirect('/');
            }

			$this->Dineromail->configure($dineroMail);
			$dineroMailData = $this->Dineromail->getFormData();
			$this->set('dineroMailData', $dineroMailData);
		}else{
			$this->Session->setFlash(__('Invalid payment gateway', true));
		}
    }

/*
	function paypal_ipn(){
		$gateway = Configure::read('PaymentGateways.Paypal') ? Configure::read('PaymentGateways.Paypal') : Configure::read('Paypal');
		$this->Paypal->configure($gateway);
		if($this->Paypal->validate_ipn()) {

			if(strtolower($this->Paypal->ipn_data['payment_status']) == 'completed'){
				// Read the info
				$control = explode('#', $this->Paypal->ipn_data['custom']);

				$model         = !empty($control[0]) ? $control[0] : null;
				$id            = !empty($control[1]) ? $control[1] : null;
				$user_id       = !empty($control[2]) ? $control[2] : null;

				switch($model){
					case 'auction':
						$auction = $this->_getAuction($id, $user_id, false);

						// Change auction status
						$status = $this->_setAuctionStatus($id, 2);

						// Check the first winners bonus
						$this->_firstWin($user_id, $id);

						// Lets deduct the spent credits
						if(Configure::read('App.credit.active')){
							$this->_credit($id, 0, $auction['Credit']['debit'], $user_id);
						}

                        // Send notification email
                        $this->_sendAuctionNotification($auction, $user_id);
						break;

					case 'package':
						$package = $this->_getPackage($id, $user_id);

						if($this->Paypal->ipn_data['mc_gross'] == $package['Package']['price']) {
							// Adding bids
							$description = __('Bids purchased - package name:', true).' '.$package['Package']['name'];
							$credit      = $package['Package']['bids'];
							$this->_bids($user_id, $description, $credit, 0);

							// Updating account
							$name  = __('Bids purchased - package name:', true).' '.$package['Package']['name'];
							$bids  = $package['Package']['bids'];
							$price = $package['Package']['price'];

							// Add bonus if it's user first purchase
							$this->_checkFirstPurchase($user_id, $bids);

							$this->_account($user_id, $name, $bids, $price);

							// Checking referral bonus
							$this->_checkReferral($user_id);

							// Check and increase user reward points
							$this->_checkRewardPoints($id, $user_id);

	                        // Send notification email
	                        $this->_sendPackageNotification($package, $user_id);
						}
						break;
				}
			}
		}else{
			$this->log('ipn validation failed.');
		}
    }

*/

 
}
?>
