<?php

class AppController extends Controller {
    
    var $helpers = array('Html', 'Form', 'Ajax', 'Time', 'Number', 'Javascript', 'Cache', 'Text', 'Session','Menu','Sidebar','Dineromail');
    var $components = array('Security', 'Acl', 'Auth', 'Acl.AclFilter', 'Cookie', 'RequestHandler', 'Session', 'Email', 'Security');
   	var $uses = array('User');
    var $view = 'Theme';      

	var $apiRequest = false; 

    var $appConfigurations;


    function beforeFilter() { 
		$this->AclFilter->auth();    
		
		$this->Auth->fields = array(
            'username'  => 'username',
            'password'  => 'password'
        ); 

 		$this->Auth->loginError = __('La conexión ha fallado. El nombre de usuario o la contraseña no son válidas.', true);
		
		$this->Security->blackHoleCallback = '__securityError';
        $this->appConfigurations = Configure::read('App');
        $this->set('appConfigurations', $this->appConfigurations);
 		$this->set('title_for_layout', __('Error: Title For Layout needed', true));

	#	$this->Setting->applyAllUpdates();
		
		if (isset($this->params['admin'])) {
			$this->layout = 'admin';
		} 
		
		if (in_array($this->RequestHandler->getClientIp(), $this->appConfigurations['allowedIps'])) { 
			Configure::write('dev', 1);
			Configure::write('debug', 2); 
			$cache = new Folder(CACHE.'Models');
			$files = $cache->read();
			foreach ($files[1] as $file) {
				if (!preg_match('/^cake_/', $file)) {
					continue;
				} 
				echo "Removing Cache file $file<br />";
	  			@unlink(CACHE.'Models'.DS.$file);
			}
		}
		
	   # $this->Auth->allow('*');  

		if (Configure::read('Site.theme')  && !isset($this->params['admin'])) {
			$this->theme = Configure::read('Site.theme');
		} elseif (Configure::read('Site.admin_theme') && isset($this->params['admin'])) {
			$this->theme = Configure::read('Site.admin_theme');
		}

		if (!isset($this->params['admin']) && 
			Configure::read('Site.status') == 0 && (!in_array($this->RequestHandler->getClientIp(), $this->appConfigurations['allowedIps']))) {    
			echo $this->RequestHandler->getClientIp();   
			$this->layout = 'maintenance';
			$this->set('title_for_layout', __('Sitio de servicio por mantenimiento', true));
			$this->render('../elements/blank');	
		}
		
		if (isset($this->params['locale'])) {
			Configure::write('Config.language', $this->params['locale']);
		}


		
		

		/*

        if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
            $this->layout = 'admin';

            if (!empty($this->appConfigurations['sslUrl'])) {
                if ($_SERVER['REQUEST_URI'] == '/'.$this->params['url']['url']) {
                    $this->redirect($this->appConfigurations['sslUrl'].$_SERVER['REQUEST_URI']);
                }
            }
        } else {
            if (!empty($this->appConfigurations['sslUrl'])) {
                if (!empty($_SERVER['HTTPS'])) {
                    if ($_SERVER['REQUEST_URI'] == '/'.$this->params['url']['url']) {
                        $allowedUrls = array('/users/register', '/users/login', '/login');
                        if (!in_array($_SERVER['REQUEST_URI'], $allowedUrls)) {
                            $this->redirect($this->appConfigurations['url'].$_SERVER['REQUEST_URI']);
                        } 
                    } elseif ($_SERVER['REQUEST_URI'] == '/') {
                        $this->redirect($this->appConfigurations['url']);
                    }
                }
            }

            if (!empty($this->params['url']) && (($this->params['url']['url'] !== 'proveedors/ingreso') || ($this->params['url']['url'] !== 'ingreso')) 
                && (($this->params['url']['url'] !== 'users/logout') || ($this->params['url']['url'] !== 'logout'))) {
                if (!$this->Auth->user('admin')) {
                    if ($_SERVER['REQUEST_URI'] !== '/offline' && empty($this->params['requested'])) {
                        #$settings = $this->Settings->get('site_live');
                        $settings = 'yes';
                        if ($settings == 'no') {
                            $this->redirect('/offline');
                        }
                    }
                }
            }
        } 

        if (empty($this->params['requested']) && isset($this->Auth)) {
            $this->_checkAuth();
        }  

		if ($this->RequestHandler->isXml() || $this->RequestHandler->ext == 'json') {  
		    Configure::write('debug',1);
			$this->Security->loginOptions = array( 
				'type'=>'basic', 
				'login'=>'authenticate', 
				'realm'=>$this->appConfigurations['name']
			);
			$this->Security->loginUsers = array(); 
			$this->Security->requireLogin(); 
			 
			$status = array();   
			if ($this->Auth->user()) {   
				if (empty($this->params['url']['api_key']) || $this->Auth->user('key') != $this->params['url']['api_key']) {
					$status['status'] = array('code' => 500, 'msg' => 'api_key_incorrect');                 
				} elseif ($this->appConfigurations['Api']['limitIp']) {   
					if ($this->Auth->user('ip') != $this->RequestHandler->getClientIp()) {
						$status['status'] = array('code' => 600, 'msg' => 'ip_no_accepted');
					}
				}
			}         
			$this->set(compact('status'));   
		} 
		*/
    }

    function _checkAuth() {      
	
		$this->Auth->userModel = 'Usuarios';
	


        $this->Auth->loginAction = array(
            'controller' => 'usuarios',
            'action' => 'ingreso'
        );

        $this->Auth->logoutRedirect = array(
            'controller' => 'usuarios',
            'action' => 'ingreso'
        );    

		$this->Auth->userScope = array('Usuarios.active' => true);         

        $this->Auth->loginError = sprintf(__('Your %s or %s is incorrect.  Please try again.', true), $this->Auth->fields['username'], $this->Auth->fields['password']);

        $this->Auth->autoRedirect = false;

        $this->Auth->authorize = 'actions';    


        if (!$this->Auth->user()) {    
            if ($id = $this->Cookie->read('Usuario.id')) {
                $user = $this->Usuario->find('first', array('conditions' => array('Usuario.id' => $id), 'contain' => ''));     
                if ($this->Auth->login($user)) {
                    $this->Session->delete('Message.Auth');
                } else {
                    $this->Cookie->delete('Usuario.id');
                }
            }
        }

        if ($this->Auth->user()) {      
            if (empty($user)) {
                $user = $this->Usuario->find('first', array('conditions' => array('Usuario.id' => $this->Auth->user('id')), 'contain' => ''));
            }
            if ($user['Usuario']['active'] == 0) {
                if ($this->Cookie->read('Usuario.id')) {
                    $this->Cookie->delete('Usuario.id');
                }
                $this->Auth->logout();
            }

            if (!Cache::read('user_count_'.$user['Usuario']['id'])) {
                Cache::write('user_count_'.$user['Usuario']['id'], microtime(), 600);
            }
        }
    }

    function isAuthorized() {
        if (!empty($this->params['admin']) && $this->Auth->user('admin') !=1) {
            return false;
        }
        return true;
    }

    function _populateLookups($models = array()) {
        if (empty($models)) {
            $rootModel = $this->{$this->modelClass};
            foreach ($rootModel->belongsTo as $model=>$attr) {
                $models[] = $model;
            }

            foreach ($rootModel->hasAndBelongsToMany as $model=>$attr) {
                $models[] = $model;
            }
        }

        foreach ($models as $model) {
            $name = Inflector::variable(Inflector::pluralize($model));
            $this->set($name, $rootModel->{$model}->find('list'));
        }
    }

    function _sendEmail($data) {
        if (!empty($data)) {   
            if ($this->Email) {
                $emailConfigurations = Configure::read('Email');  
  				
			   	if (!empty($emailConfigurations['delivery'])) {
					$this->Email->delivery = $emailConfigurations['delivery'];
				} else {
					$this->log('_sendEmail(), Delivery parameter required. smtp|mail|debug');
					return false;
				} 
				
				if ($emailConfigurations['delivery'] == 'smtp') {  
					if (!empty($emailConfigurations['smtpOptions'])) {
						$emailSmtpOptions = $emailConfigurations['smtpOptions'];
						if (!empty($emailSmtpOptions['host'])) {
							$this->Email->smtpOptions['host'] = $emailSmtpOptions['host'];
						} else {
							$this->log('_sendEmail(), Host parameter required');
							return false;
						}
						if (!empty($emailSmtpOptions['port'])) {
		                    $this->Email->smtpOptions['port'] = $emailSmtpOptions['port'];
		                } else {
		                    $this->log('_sendEmail(), Port parameter required');
		                    return false;
		                }
		                if (!empty($emailSmtpOptions['auth']) && $emailSmtpOptions['auth'] === true) { 
							$this->Email->smtpOptions['auth'] = $emailSmtpOptions['auth'];
			 				if (!empty($emailSmtpOptions['username'])) {
				            	$this->Email->smtpOptions['username'] = $emailSmtpOptions['username'];
						  	} else {
							  	$this->log('_sendEmail(), Username parameter required when using Auth and SMTP');
								return false;
							}  
							if (!empty($emailSmtpOptions['Password'])) {
		                        $this->Email->smtpOptions['password'] = $emailSmtpOptions['password'];
		                    } else {
		                        $this->log('_sendEmail(), Password parameter required when using Auth and SMTP');
		                        return false;
		                    }
						} else {
							$this->Email->auth = false;
						}
						if (!empty($emailSmtpOptions['timeout'])) {
							$this->Email->smtpOptions['timeout'] = $emailSmtpOptions['timeout'];
						}                                                                       
						if (!empty($emailSmtpOptions['client'])) {
							$this->Email->smtpOptions['client'] = $emailSmtpOptions['client'];
						}

					} else {
						$this->log('_sendEmail(), SmtpOptons are required when sending via SMTP');
						return false;
					}
				}
				if (!empty($emailConfigurations['lineLength'])) {
                    $this->Email->lineLength = $emailConfigurations['lineLength'];
				}
				if (!empty($emailConfigurations['replyTo'])) {
					$this->Email->replyTo = $emailConfigurations['replyTo']; 
					$this->Email->return = $emailConfigurations['return'];
				}
                if (!empty($emailConfigurations['from'])) {
                    $this->Email->from = $emailConfigurations['from'];
                } else {
                    $this->log('_sendEmail(), From name parameter required');
                    return false;
                }
                if (!empty($data['subject'])) {
                    $this->Email->subject = $data['subject'];
                } else {
                    $this->log('_sendEmail(), Subject paramerter required');
                    return false;
                }  

                if (!empty($data['to'])) { 
					$to = array();
                    if (is_array($data['to'])) {  
                        foreach ($data['to'] as $recipient) {
                            if (!empty($recipient['name'])) { 
							   	$to[] = "<".$recipient['name']."> ". $recipient['to'];
                            } else {
                                $to[] = $recipient['to'];
                            }
                        }
                    } else {
                        if (!empty($data['name'])) {
							$to[] = "<".$data['name']."> ". $data['to'];
                        } else {
                             $to[] = $data['to'];      
                        }
                    }
				   	if (!empty($to)) {
						$this->Email->to = $to;
					} else {
						$this->log('_sendEmail(), To array empty.');
						return false;
					}
                } else {
                    $this->log('_sendEmail(), To parameter required');
                    return false;
                }

 				if (!empty($data['cc'])) { 
					$cc = array();
                    if (is_array($data['cc'])) {  
                        foreach ($data['cc'] as $recipient) {
                            if (!empty($recipient['name'])) { 
							   	$cc[] = "<".$recipient['name']."> ". $recipient['to'];
                            } else {
                                $cc[] = $recipient['to'];
                            }
                        }
                    }
				   	if (!empty($cc)) {
						$this->Email->cc = $cc;
					} else {
						$this->log('_sendEmail(), Cc array empty.');
						return false;
					}
                }

				if (!empty($data['bcc'])) { 
					$bcc = array();
                    if (is_array($data['bcc'])) {  
                        foreach ($data['bcc'] as $recipient) {
                            if (!empty($recipient['name'])) { 
							   	$bcc[] = "<".$recipient['name']."> ". $recipient['to'];
                            } else {
                                $bcc[] = $recipient['to'];
                            }
                        }
                    }
				   	if (!empty($bcc)) {
						$this->Email->bcc = $bcc;
					} else {
						$this->log('_sendEmail(), Bcc array empty.');
						return false;
					}
                }

                #$tmp = array(
                #    'autoRender' =>  $this->autoRender,
                #    'autoLayout' => $this->autoLayout,
                ##    'layout' => $this->layout,
                #    'viewPath' => $this->viewPath,
                #);


                
                #$this->autoRender = false;
                #$this->autoLayout = false;

                if (!empty($data['layout'])) {
                    $this->Email->layout = $data['layout'];
                }  

                if (empty($data['template'])) {
                    $this->Email->template = $this->action;
                } else {
					$this->Email->template = $data['template'];
			  	}

                if (!empty($emailConfigurations['sendAs'])) {
	            	$this->Email->sendAs = $emailConfigurations['sendAs'];
				}    


                #if (!empty($emailConfigurations['IsHTML'])) {
                #    $this->Mailer->IsHTML($emailConfigurations['IsHTML']);
                #    $this->layout = 'email'.DS.'html'.DS.$data['layout'];
                #    $this->viewPath = 'elements'.DS.'email'.DS.'html';
                #    $bodyHtml = $this->render($data['template']);
                #    $this->Mailer->MsgHTML($bodyHtml);
                #} else {
                #    $this->layout = 'email'.DS.'text'.DS.$data['layout'];
                #    $this->viewPath = 'elements'.DS.'email'.DS.'text';
                #    $bodyText = $this->render($data['template']);
                #    $this->Mailer->AltBody = $bodyText;
                #} 

                // Get things back to normal
                #$this->autoRender = $tmp['autoRender'];
                #$this->autoLayout = $tmp['autoLayout'];
                #$this->layout = $tmp['layout'];
                #$this->viewPath = $tmp['viewPath'];
				$this->set('data', $data);
				
                if ($return = $this->Email->Send()) {
					if (!empty($this->Email->smtpError)) {
						$this->log($this->Email->smtpErrors);
					}
                    $return = false;
                }   

                $this->Email->reset();

                return $return;
            } else {
                $this->log('_sendEmail(), Mailer component required');
                return false;
            }
        } else {
            $this->log('_sendEmail(), data parameter required');
            return false;
        }
    }    

	function authenticate($args) {       
		$data[$this->Auth->fields['username']] = $args['username'];
		$data[$this->Auth->fields['password']] = $this->Auth->password($args['password']);  
		if ($this->Auth->login($data)) { 
			return true;
		} else {  
			$this->Security->blackHole($this, 'login');
			return false;
		}
	} 
	
	function clear_cache() {
		Cache::clear();   
		die('here');
	}

    function build_acl() {
        if (!Configure::read('debug')) {
            return $this->_stop();
        }
        $log = array();

        $aco =& $this->Acl->Aco;
        $root = $aco->node('controllers');
        if (!$root) {
            $aco->create(array('parent_id' => null, 'model' => null, 'alias' => 'controllers'));
            $root = $aco->save();
            $root['Aco']['id'] = $aco->id; 
            $log[] = 'Created Aco node for controllers';
        } else {
            $root = $root[0];
        }   

        App::import('Core', 'File');
        $Controllers = Configure::listObjects('controller');
        $appIndex = array_search('App', $Controllers);
        if ($appIndex !== false ) {
            unset($Controllers[$appIndex]);
        }
        $baseMethods = get_class_methods('Controller');
        $baseMethods[] = 'buildAcl';

        $Plugins = $this->_getPluginControllerNames();
        $Controllers = array_merge($Controllers, $Plugins);

        // look at each controller in app/controllers
        foreach ($Controllers as $ctrlName) {
            $methods = $this->_getClassMethods($this->_getPluginControllerPath($ctrlName));

            // Do all Plugins First
            if ($this->_isPlugin($ctrlName)){
                $pluginNode = $aco->node('controllers/'.$this->_getPluginName($ctrlName));
                if (!$pluginNode) {
                    $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginName($ctrlName)));
                    $pluginNode = $aco->save();
                    $pluginNode['Aco']['id'] = $aco->id;
                    $log[] = 'Created Aco node for ' . $this->_getPluginName($ctrlName) . ' Plugin';
                }
            }
            // find / make controller node
            $controllerNode = $aco->node('controllers/'.$ctrlName);
            if (!$controllerNode) {
                if ($this->_isPlugin($ctrlName)){
                    $pluginNode = $aco->node('controllers/' . $this->_getPluginName($ctrlName));
                    $aco->create(array('parent_id' => $pluginNode['0']['Aco']['id'], 'model' => null, 'alias' => $this->_getPluginControllerName($ctrlName)));
                    $controllerNode = $aco->save();
                    $controllerNode['Aco']['id'] = $aco->id;
                    $log[] = 'Created Aco node for ' . $this->_getPluginControllerName($ctrlName) . ' ' . $this->_getPluginName($ctrlName) . ' Plugin Controller';
                } else {
                    $aco->create(array('parent_id' => $root['Aco']['id'], 'model' => null, 'alias' => $ctrlName));
                    $controllerNode = $aco->save();
                    $controllerNode['Aco']['id'] = $aco->id;
                    $log[] = 'Created Aco node for ' . $ctrlName;
                }
            } else {
                $controllerNode = $controllerNode[0];
            }

            //clean the methods. to remove those in Controller and private actions.
            foreach ($methods as $k => $method) {
                if (strpos($method, '_', 0) === 0) {
                    unset($methods[$k]);
                    continue;
                }
                if (in_array($method, $baseMethods)) {
                    unset($methods[$k]);
                    continue;
                }
                $methodNode = $aco->node('controllers/'.$ctrlName.'/'.$method);
                if (!$methodNode) {
                    $aco->create(array('parent_id' => $controllerNode['Aco']['id'], 'model' => null, 'alias' => $method));
                    $methodNode = $aco->save();
                    $log[] = 'Created Aco node for '. $method;
                }
            }
        }
        if(count($log)>0) {
            debug($log);
        }
    }

    function _getClassMethods($ctrlName = null) {
        App::import('Controller', $ctrlName);
        if (strlen(strstr($ctrlName, '.')) > 0) {
            // plugin's controller
            $num = strpos($ctrlName, '.');
            $ctrlName = substr($ctrlName, $num+1);
        }
        $ctrlclass = $ctrlName . 'Controller';
        $methods = get_class_methods($ctrlclass);

        // Add scaffold defaults if scaffolds are being used
        $properties = get_class_vars($ctrlclass);
        if (array_key_exists('scaffold',$properties)) {
            if($properties['scaffold'] == 'admin') {
                $methods = array_merge($methods, array('admin_add', 'admin_edit', 'admin_index', 'admin_view', 'admin_delete'));
            } else {
                $methods = array_merge($methods, array('add', 'edit', 'index', 'view', 'delete'));
            }
        }
        return $methods;
    }

    function _isPlugin($ctrlName = null) {
        $arr = String::tokenize($ctrlName, '/');
        if (count($arr) > 1) {
            return true;
        } else {
            return false;
        }
    }

    function _getPluginControllerPath($ctrlName = null) {
        $arr = String::tokenize($ctrlName, '/');
        if (count($arr) == 2) {
            return $arr[0] . '.' . $arr[1];
        } else {
            return $arr[0];
        }
    }

    function _getPluginName($ctrlName = null) {
        $arr = String::tokenize($ctrlName, '/');
        if (count($arr) == 2) {
            return $arr[0];
        } else {
            return false;
        }
    }

    function _getPluginControllerName($ctrlName = null) {
        $arr = String::tokenize($ctrlName, '/');
        if (count($arr) == 2) {
            return $arr[1];
        } else {
            return false;
        }
    }

/**
 * Get the names of the plugin controllers ...
 * 
 * This function will get an array of the plugin controller names, and
 * also makes sure the controllers are available for us to get the 
 * method names by doing an App::import for each plugin controller.
 *
 * @return array of plugin names.
 *
 */
    function _getPluginControllerNames() {
        App::import('Core', 'File', 'Folder');
        $paths = Configure::getInstance();
        $folder =& new Folder();
        $folder->cd(APP . 'plugins');

        // Get the list of plugins
        $Plugins = $folder->read();
        $Plugins = $Plugins[0];
        $arr = array();

        // Loop through the plugins
        foreach($Plugins as $pluginName) {
            // Change directory to the plugin
            $didCD = $folder->cd(APP . 'plugins'. DS . $pluginName . DS . 'controllers');
            // Get a list of the files that have a file name that ends
            // with controller.php
            $files = $folder->findRecursive('.*_controller\.php');

            // Loop through the controllers we found in the plugins directory
            foreach($files as $fileName) {
                // Get the base file name
                $file = basename($fileName);

                // Get the controller name
                $file = Inflector::camelize(substr($file, 0, strlen($file)-strlen('_controller.php')));
                if (!preg_match('/^'. Inflector::humanize($pluginName). 'App/', $file)) {
                    if (!App::import('Controller', $pluginName.'.'.$file)) {
                        debug('Error importing '.$file.' for plugin '.$pluginName);
                    } else {
                        /// Now prepend the Plugin name ...
                        // This is required to allow us to fetch the method names.
                        $arr[] = Inflector::humanize($pluginName) . "/" . $file;
                    }
                }
            }
        }
        return $arr;
    }
}
