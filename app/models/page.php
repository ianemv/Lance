<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'name';
	
	function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
		
		$this->validate = array(
			'first_name' => array(
				'first_name' => array(
					'rule' => 'notEmpty',
					'message' => __('Tienes que ingresar tu nombre.', true)
				)
			),
			'last_name' => array(
				'title' => array(
					'rule' => 'notEmpty',
					'message' => __('Tienes que ingresar tu apellido.', true)
				)
			),
			'email' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __('Tienes que ingresar un mail.', true)
				),
				'email' => array(
					'rule' => 'email',
					'message' => __('El mail que ingresaste no es válido.', true)
				),
			),
			'message' => array(
				'message' => array(
					'rule' => 'notEmpty',
					'message' => __('Por favor, ingresa un mensaje.', true)
				)
			),
		);
	}
	
	
	function beforeSave() {
		if (!empty($this->data)) {
			if (!empty($this->data['Page']['name'])) {
				if (!empty($this->data['Page']['id'])) {
					$this->data['Page']['slug'] = $this->generateNiceName($this->data['Page']['name'], $this->data['Page']['id']);
				} else {
					$this->data['Page']['slug'] = $this->generateNiceName($this->data['Page']['name']);
				}
			}
			
			if (!empty($this->data['Page']['id'])) {
				if (empty($this->data['Page']['top_show'])) {
					$this->data['Page']['top_order'] = 0;
				}                                        
				if (empty($this->data['Page']['bottom_show'])) {
					$this->data['Page']['bottom_order'] = 0;
				}                                            
			} else {
				if (!empty($this->data['Page']['top_show'])) {
					$this->data['Page']['top_order'] = $this->getLastOrderNumber('top');
				}                                        
				if (!empty($this->data['Page']['bottom_show'])) {
					$this->data['Page']['bottom_order'] = $this->getLastOrderNumber('bottom');
				}
			}                                                                                          
		} 
		return true;
	}
	
	function getLastOrderNumber($position = null) {
		$this->recursive = -1;
		$lastItem = $this->find('first', array('conditions' => array($position.'_show' => 1), 'order' => array($position.'_order' => 'desc')));
		if (!empty($lastItem)) {
			return $lastItem['Page'][$position.'_order'] + 1;
		} else {
			return 0;
		}
	}
	
}
?>