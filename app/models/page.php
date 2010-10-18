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
	
}
?>