<?php


class User extends AppModel {

    var $name = 'User';

	var $order = 'name ASC';

    var $actsAs = array(
        'Containable', 
        'Acl.Acl' => 'requester',
    /*    'Expandable' => array(
            'with' => 'UserMetaData',
            'key' => 'key',
            'value' => 'value'
        ) */
    );

    var $belongsTo = array('Group');

	var $hasMany = array( 
		'Account' => array(
		 	'className' => 'Account',
			'foreignKey' => 'user_id',
			'dependent' => true,
		),
		'UserMetaData' => array(
			'className' => 'UserMetaData',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PlazaComment' => array(
			'className' => 'PlazaComment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Donation' => array(
			'className' => 'Donation',
			'foreignKey' => 'user_id',
		)
	);


    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->validate = array(
           'username' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __('Tienes que ingresar el nombre de usuario.', true),
				),
                'between' => array(
                    'rule' => array('between', 3, 255),
                    'message' => __('El nombre del usuario debe ser entre 3 y 16 caracteres.', true),
                ),  
				'isUnique' => array(
                	'rule' => array('isUnique' , 'username'),
                	'message' => __('El nombre del usuario ya existe. Por favor escoge otro.', true)
              	),
            ), 
            'password_before' => array(
                'between' => array(
                    'rule' => array('between', 6, 20),
                    'message' => __('Tu contraseña debe ser entre 6 y 20 caracteres.', true)
                ),   
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __('Tienes que ingresar una contraseña.', true),
				),
            ),
            'password_confirmation' => array(
                'matchFields' => array(
                    'rule' => array('matchFields', 'password_before'),
                    'message' => __('Los dos contraseñas no son equales.', true)
                ),
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __('Tienes que ingresar una contraseña de confirmación.', true),
				), 
            ),  
            'email' => array(
                'email' => array(
                    'rule' => 'email',
                    'message' => __('Tienes que ingresar un Email válido.', true)
                ),
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __('Tienes que ingresar una mail.', true),
				),  
				'isUnique' => array(
                	'rule' => array('isUnique', 'email'),
                	'message' => __('Este mail ya existe.  Por favor escoge otro.', true),
			  		'on' => 'create',
             	),
            ),
        );
    }

	function parentNode($type='Aro') {  
		if ($type == 'Aro') {
			if (!$this->id && empty($this->data)) {
				return null;
			}
		
			$data = $this->data;
			if (empty($this->data)) {
				$data = $this->read();
			}           

			if (empty($data['User']['group_id'])) {
				return null;              
			} else {
				return array('model' => 'Group', 'foreign_key' => $data['User']['group_id']);
			}
  		}
		return false;
	}

	function afterSave($created) {      
		if (!$created) {
			$parent = $this->parentNode();   
			$parent = $this->node($parent);
			$node = $this->node();   
			$aro = $node[0];
			$aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
			$this->Aro->save($aro);
		}
	}

    function register($data, $id = null) {
        if (is_array($data)) {   
            #if (!empty($data['User'])) {
				if (empty($id) || !empty($data['User']['reset_key'])) {
					$data['User']['key']  = Security::hash(uniqid(rand(), true).Configure::read('Security.salt'));
				}
                
                if (!empty($data['User']['password_before'])) {
                    $data['User']['password'] = Security::hash(Configure::read('Security.salt').$data['User']['password_before']);
                }

                if (!empty($id)) {
                    $data['User']['id'] = $id;
                } else {  
					$data['User']['active'] = 0;
					$data['User']['ip'] = $_SERVER['REMOTE_ADDR'];
                    $this->create();
                } 
				if (empty($data['User']['group_id'])) {
					$data['User']['group_id'] = 2;
				}  

                if ($user = $this->save($data)) {
	   				// Check for Account Data and save it too
					if (!empty($data['Account'])) {
						$data['Account']['user_id'] = $this->id;
						$this->Account->save($data);
					} 

					$user['User']['id'] 			= $this->id;
                    $user['User']['activate_link']  = $this->appConfigurations['url'].'/users/activate/'. $user['User']['key'];
                    $user['to']                     = $user['User']['email'];
					$user['subject']            	= sprintf(__('Verificación de tu registro - %s', true), $this->appConfigurations['name']);
                   	$user['template']               = 'users/activate';    

                    return $user;
                } else { 
                    return false;
                }

            #} else {
            #    return false;
            #}
        }
    }

    function recover($data, $newPasswordLength = 8) {
        $conditions = array();

        if (is_array($data)) {
            if (!empty($data['User'])) {
                foreach ($data['User'] as $key => $datum) {
                    if ($this->hasField($key)) {
                        $conditions[$key] = $datum;
                    }
                }                    

                $user = $this->find('first', array('conditions' => $conditions));

                if (!empty($user)) {

                    $user['User']['key']             = Security::hash(uniqid(rand(), true));

                    $user['User']['password_before'] = substr(sha1(uniqid(rand(), true)), 0, $newPasswordLength);
                    $user['to']                      = $user['User']['email'];
                    $user['subject']                 = sprintf(__('Tu contraseña - %s', true), $this->appConfigurations['name']);
                    $user['template']                = 'users/reset';

                    $user['User']['password']        = Security::hash(Configure::read('Security.salt').$user['User']['password_before']);
                    $user['User']['reset_link']      = $this->appConfigurations['url'].'/users/reset/'. $user['User']['key'];
                                                                                                                                
                    $this->save($user, false);
                    return $user;
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

	function reset($data, $id = null) {
		if (is_array($data)) {
			if (!empty($data['User'])) {
				if (!empty($data['User']['password_before'])) {
                	$data['User']['password'] = Security::hash(Configure::read('Security.salt').$data['User']['password_before']);
					if (!empty($id)) {
		          		$data['User']['id'] = $id;   
						if ($this->save($data)) {
							return true;
						}
					}
          		}  
			}
		}
		return false;
	}

    function resetKey($key) {
        if (isset($key)) {
            $user = $this->find('first', array('conditions' => array('User.key' => $key)));   
            if (!empty($user)) {   
			   	$user['User']['key'] = '';
				$this->save($user);
			   	return $user;
            } else {
                return false;
            }
		} 
		return false;
    }      

    function resend($email) {
        if (!is_null($email)) { 
            $user = $this->findByEmail($email);   
            if (!empty($user) && !$user['User']['active']) {

                $data['User']['key']    = Security::hash(uniqid(rand(), true));
                $this->read(null, $user['User']['id']);
                $this->save($data);
                
                $user['User']['activate_link']  = $this->appConfigurations['url'].'/users/activate/'. $data['User']['key'];
                $user['to']                     = $user['User']['email'];
                $user['subject']            = sprintf(__('Verificación de tu registro - %s', true), $this->appConfigurations['name']);
                $user['template']               = 'users/activate';

                return $user;
            } 
        }
        return false;
    }


    function activate($key) {
        $user = $this->find('first', array('conditions' => array('User.key' => $key, 'User.active' => 0))); 

        if (!empty($user)) {
            $user['User']['active'] = 1;
            $user['User']['key'] = ''; 

			$this->save($user);
			
            $user['to']                     = $user['User']['email'];
            $user['subject']                = sprintf(__('Bienvenido a %s, %s', true), $this->appConfigurations['name'], $user['User']['username']);
            $user['template']               = 'users/welcome';

            return $user;
        } else {
            return false;
        }
    }

    function generateRandomPassword($length = 8, $randomString = null) {
        if(empty($randomString)){
            $randomString = 'pqowieurytlaksjdhfgmznxbcv1029384756';
        }   
        $newPassword = ''; 

        for($i=0;$i<$length;$i++){
            $newPassword .= substr($randomString, mt_rand(0, strlen($randomString)-1), 1); 
        }   
        return $newPassword;
    }

	function getUserByIdOrUsername($id = null) {
		if (!empty($id)) { 
			$user = $this->find('first', 
				array(
					'conditions' => array(
						'OR' => array(
							array('User.id' => $id),
							array('User.username' => $id)
						),
					),
				)
			);

			if (!empty($user)) {
				return $user;
			}
		}
		return false;
	}
}
