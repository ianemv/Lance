<?php
class PlazaImage extends AppModel {
	var $name = 'PlazaImage';
	var $displayField = 'plaza_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Plaza' => array(
			'className' => 'Plaza',
			'foreignKey' => 'plaza_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>