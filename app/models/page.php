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
					'message' => __('Tienes que entrar tu nombre.', true)
				)
			),
			'last_name' => array(
				'title' => array(
					'rule' => 'notEmpty',
					'message' => __('Tienes que entrar un apellido', true)
				)
			),
			'email' => array(
				'notEmpty' => array(
					'rule' => 'notEmpty',
					'message' => __('Tienes que entrar un mail.', true)
				),
				'email' => array(
					'rule' => 'email',
					'message' => __('El mail que ingresaste no es valido.', true)
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