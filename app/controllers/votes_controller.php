<?php


class VotesController extends AppController {

    var $name = 'Votes';


	function plaza() {

	    $this->layout = 'json';
        if (!$this->RequestHandler->isAjax()) {
            $this->redirect('/');
        }

        $message = null;
        $success = false;
        $login = true;  

		#if (!$this->Session->check('Vote')) {
			if (!$this->Session->check('Auth.User')) { 
				if ($this->appConfigurations['votes']['limits']['force_login']) { 
					// Limits set to force login, and user not logged in
					$message = sprintf(__('Debe estar registrado para continuar. Por favor, regístrate', true));
					$canVote = false;
					$login = true;
				}            
                $canVote = false;
				if (!empty($this->data['User']) && !empty($this->data['User']['username'])) {    
					if ($this->Auth->login($this->data['User'])) {
			 			$user = $this->Auth->user(); 
						$canVote = true;
					} else {    
						$message = $this->Auth->loginError;
		   				$canVote = false;
					}

					/* 
					if (array_key_exists('full_name', $this->data['User'])) {
						if (!empty($this->data['User']['full_name']) && strpos($this->data['User']['full_name'], ' ')) { 
							list($first_name, $last_name) = explode(" ", $this->data['User']['full_name']); 
							$this->data['User']['first_name'] = ($first_name)?$first_name:"";
							$this->data['User']['last_name'] = ($last_name)?$last_name:"";
						} elseif(array_key_exists('full_name', $this->data['User'])) {
							$this->data['User']['first_name'] = "";
							$this->data['User']['last_name'] = "";
						}
				  	}                                         

				  	$canVote = true;   
					$user = $this->User->findByEmail($this->data['User']['email']);     
					if (empty($user)) {     
						$user['User']['group_id']       = 2;  // Adding User
		                $user['User']['username']       = $this->data['User']['email'];
		                $user['User']['first_name']     = $this->data['User']['first_name'];
		                $user['User']['last_name']      = $this->data['User']['last_name'];
		                $user['User']['email']          = $this->data['User']['email'];
		                $user['User']['password_before']= $this->User->generateRandomPassword();
		                $user['User']['active']         = 1;   
                            
						$this->User->set($user);
						#if ($this->User->validates(array('fieldList' => array('first_name', 'last_name', 'email')))) {
							if (!$user = $this->User->register($user)) {  
								//User coudn't be created        '
			          			$message = implode(", ", $this->User->invalidFields());
			                    $canVote = false;
							  	$login = true;    
			                } 
				   		#} else {
							
						#}
					}  
					*/         
				} else {   
					$login = true;
					$canVote = false;
				}
		 	} else { 
				// User Authenticated, Continue
			   	$user = $this->Auth->user();
			  	$canVote = true;
			}
	  	#} else { 
		#	// User has voted and has a session
		#	$user['User'] = $this->Session->read('Vote');  
		#	$canVote = true;
		#}
		     
		if ($canVote && !empty($this->data['Vote']['plaza_id'])) {   

           	$plaza_id = $this->data['Vote']['plaza_id'];
           	$user_id = $user['User']['id'];
           	$plaza = $this->Vote->Plaza->find('first', array('conditions' => array('Plaza.id' => $plaza_id)));
         
           	if (!empty($plaza)) {
               	if (!empty($this->appConfigurations['votes']['limits']['active'])) {
                   	$limits_exceeded = $this->Vote->limitsCanVote($plaza['Plaza']['id'], $user_id);
                   	if ($limits_exceeded == false) { 
						$this->Auth->logout();
                       	$message = __('No puedes votar porque has pasado los límites de votación. Intenta mañana', true);
                       	$canVote = false;  
						$login = false;
                   	}
               	}

               	if ((!empty($plaza['Plaza']['closed']) || (!empty($plaza['PLaza']['end_time']) && strtotime($plaza['Plaza']['end_time']) <= time()))) {
                	$message = sprintf(__('La votación esta cerrada para esta %s.', true), __('plaza', true));
                   	$canVote = false;
               	}
             
               	if (!empty($plaza['Plaza']['start_time'])) {
                   	if (strtotime($plaza['Plaza']['start_time']) > time()) {
                       	$message = sprintf(__('La votación para esta %s no ha empezado todavia.', true), __('Plaza', true));
                       	$canVote = false;
                   	}
               	}
           	} else {
               	$message = __('No se puede encontrar la plaza.  Ententalo denuevo', true);
           	}
           	
			if ($canVote) {
               	$vote['plaza_id'] = $plaza_id;
               	$vote['user_id'] = $user_id;
               	$this->Vote->create();
               	if ($this->Vote->save($vote)) { 
					$this->Session->write('Vote', $user['User']);
                   	$message = __('Gracias por votar.', true);
                   	$success = true;
               	} else {
                   	$message = __('Hay un problema con tu voto, por favor contactanos.', true);
                   	$success = false;
               	}
           	} else {
            	$success = false;
       		}
		} 
        
       	if (!$success) {
            $this->set('message', $message);
            $message = $this->render('/elements/error');
            $this->output = "";
        } else {
            $this->set('message', $message);
            $message = $this->render('/elements/success');
            $this->output = "";
        } 

        $vote = array('success' => $success, 'message' => $message, 'login' => $login);
        $this->set('data', $vote);
        $this->render('/votes/plaza');
	}

    function count() {
        $this->layout = 'ajax';
        $count = 0;
        $plaza_id = 0;
        if (!empty($this->params['url']['id'])) {
            $plaza_id = $this->params['url']['id'];
            $params = array('conditions' => array('Vote.plaza_id' => $plaza_id));
            $count = $this->Vote->find('count', $params);
        }
        $data = array('url' => $plaza_id, 'votes' => $count, 'id' => $plaza_id);
        $this->set('data', $data);
    }

}
