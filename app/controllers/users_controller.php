<?php



class UsersController extends AppController {

    var $name = 'Users';

    var $components = array('Recaptcha');
    var $helpers = array('Recaptcha');

    function beforeFilter() {
        parent::beforeFilter();

        if (!empty($this->Auth)) {    
			$this->Auth->allow('*');
            #$this->Auth->allow('activate', 'register', 'reset', 'recover', 'resend', 'login', 'logout', 'admin_recover');
        }
    }

    function index() {}

    function login() {      
		$this->set('title_for_layout', __('Entrar', true));           
        if (!empty($this->data)) {    
            if ($this->data['User']['remember_me'] == 1) {    
                $this->Cookie->write('User.id', $this->Auth->user('id'));
            }
        }
        
        if ($this->Session->check('Auth.User')) {
            $this->redirect($this->Auth->redirect());
        }
    }
    
    function logout() { 
	  	$this->Auth->logout();
		if ($this->Cookie->read('User.id')) { 
			$this->Cookie->delete('User.id');
	    }
        $this->redirect('/');
    }

    function register($status = '') { 
		$this->set('title_for_layout', __('Registro', true));  
        if (!$this->Session->check('Auth.User')) {
            if (!empty($this->data)) {
                if ($user = $this->User->register($this->data)) { 
                    $this->_sendEmail($user);
                    $this->Session->write('Registration.email', $user['to']);
                    $this->redirect(array('action' => 'register', 'success'));
                } else {
                    $this->Session->setFlash(__('No pudimos registrar tu cuenta.', true), 'error');
                }
            } elseif ($status) {
                if ($this->Session->check('Registration.email')) {
                    $this->set('email', $this->Session->read('Registration.email'));
                    $this->render($this->action.'_'.$status);
                } else {
                    $this->redirect(array('action' => 'register'));
                }
            }
        } else {
            $this->redirect('/');
        }
    }


    function activate($key = null) {  
        if (!$this->Session->check('Auth.User')) {
            if (!is_null($key)) {
                if ($user = $this->User->activate($key)) {
                    $this->Auth->login($user);
                    #$this->_sendEmail($user);
                    $this->Session->setFlash(__('Tu cuenta ha sido verificada', true), 'success');
					$this->redirect('/plazas');
                    #$this->redirect(array('action' => 'done'));
                } else {
                    $this->Session->setFlash(__('Tu cuenta ya está activada. Por favor ingresa tus datos directamente al momento de votar por tu plaza favorita.', true), 'error');
                    $this->redirect('/plazas');
                }
            } else {
                $this->redirect('/plazas');
            }
        } else {
            $this->redirect('/');
        }
    }

    function done() {     
		if ($this->Session->check('Auth.User')) {
        	if (!empty($this->data)) {   
            	if ($this->Auth->user('id')) {
                	$user = $this->User->read(null, $this->Auth->user('id'));
                	$this->User->save($this->data);
                	$this->Auth->login($user);
                	$this->redirect($this->Auth->redirect('/'));
            	} else {
                	$this->redirect(array('action' => 'login'));
            	}
        	} else {
            	$this->data = $this->Auth->user();
        	} 
		} else {
			$this->redirect('/');
		}
    }

    function skip() {
        $this->redirect($this->Auth->redirect('/'));
        // Track User/Insert History
        // Send to Home Page
    }

    function recover() {   
		$this->set('title_for_layout', __('¿Olvidaste tu contraseña?', true));
        if (!empty($this->data)) {
            if ($user = $this->User->recover($this->data)) {
                $this->_sendEmail($user);
                $this->Session->setFlash(__('Tu contraseña ha sido enviada a tu correo electrónico', true), 'success');  
                $this->redirect(array('action' => 'recover'));
            } else {
                $this->Session->setFlash(__('Tu email no está registrado', true), 'error'); 
            }
        }
    }

    function reset($key = null) {
	   $this->set('title_for_layout', __('', true));
        if (!is_null($key)) {  
			if ($user = $this->User->resetKey($key)) {
				$this->Session->write('Reset.User', $user); 
			}
		}  

		if ($user = $this->Session->read('Reset.User')) { 
			$this->set('user', $user);  
	  		if (!empty($this->data)) {  
				if ($this->User->reset($this->data, $user['User']['id'])) {
					$this->Session->delete('Reset');
					$this->redirect('/');
				}   
        	}    
		} else {
			$this->redirect('/');
		}
    }

    function resend($email = null) {
        if (!is_null($email)) {
            if ($user = $this->User->resend($email)) {
                $this->_sendEmail($user);  
				$this->Session->setFlash(__('Acabamos de volver a enviar el email de confirmación, por favor revisa tu inbox de tu email.', true), 'success');
            } else {
                $this->Session->setFlash(__('No se puede enviar un correo electrónico de activación. Puede ser que la cuenta ya está activa o el correo electrónico no exisit.', true), 'error'); 
            }
        }
		$this->redirect('/');
    }

	function changepassword() {

		$this->set('title_for_layout', __('Change Password', true));
		if (!empty($this->data)) {
			if ($user = $this->User->reset($this->data)) {
				$this->Session->setFlash(__('Password has been changed.', true));
				$this->redirect(array('action' => 'index'));
			} else {                                        
				$this->Session->setFlash(__('Unable to change password. Please try again.', true));
				$this->redirect(array('action' => 'changepassword'));
			}                                                                    
		}
	}
	
	function admin_recover() {
		$this->set('title_for_layout', __('Recover Password', true));   
		$valid = false;  
		$message = null;
		if (!empty($this->data)) {
		 	if ($user = $this->User->recover($this->data)) {
		   		$this->_sendEmail($user);
		  	  	$this->Session->setFlash(__('Your password has just been set to the e-mail address.', true), 'message/success', array('class' => 'no-margin')); 
	   			$valid = true;
			} else {
				$message = __('The email you provided was not found.', true);  
				$valid = false;
			}
		}
		if ($this->RequestHandler->isAjax()) { 
			$this->layout = 'ajax';
			$this->autoRender = false; 
   			
			return json_encode(
				array(
					'valid' => $valid,
					'error' => $message, 
					'redirect' => 'login' 
				)
			); 
		} else {  
		   	$this->layout = "admin_login";
			if (!empty($message)) {
				$this->Session->setFlash($message);
			}
		} 
	}


    function admin_login() {  
		$this->set('title_for_layout', __('Administration Login', true)); 
		$valid = false;
		$message = false;
		if (!$this->Session->check('Auth.User')) { 
			if (!empty($this->data)) {    
				if ($this->Auth->login($this->data)) {
					$valid = true;  
					if ($this->data['User']['remember_me'] == 1) {
						$this->Cookie->write('User.id', $this->Auth->user('id'));
					}
				} else {
					$valid = false; 
 					$message = $this->Auth->loginError;
					$this->Auth->loginError = "";
				}
			}
   		}      
		
		if ($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';  
			$this->autoRender = false;
			return json_encode(
				array(
					'valid' => $valid,
					'error' => $message,
					)
				);
			
		} else {
			$this->layout = "admin_login"; 
			if (!empty($message)) {
		   		$this->Session->setFlash($message);  
			}
		}  

    }

	function admin_logout() {
		if ($this->Cookie->read('User.id')) { 
			$this->Cookie->delete('User.id');
	    }
        $this->redirect($this->Auth->logout());
    }

	function admin_index() {
		$this->set('title_for_layout', __('Users', true));
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'), 'attention');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->register($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'), 'message/success', array('class' => 'no-margin', 'close' => true));
				$this->redirect(array('action' => 'index'));
			} else { 
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'), 'message/error', array('class' => 'no-margin','close' => true));
			}
		}   
		$this->set('title_for_layout', sprintf(__('Add %s', true), 'User'));        
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'user'), 'message/warning', array('class' => 'no-margin', 'close' => true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->register($this->data, $id)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'user'), 'message/success', array('class' => 'no-margin', 'close' => true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'user'), 'message/error', array('class' => 'no-margin', 'close' => true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$this->set('title_for_layout', sprintf(__('Edit "%s"', true), $this->data['User']['username']));
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'User'), 'message/warning', array('class' => 'no-margin', 'close' => true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'User'), 'message/success', array('class' => 'no-margin', 'close' => true));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(sprintf(__('Unable to delete %s', true), 'User'), 'message/error', array('class' => 'no-margin', 'close' => true));
		}
	}
}
