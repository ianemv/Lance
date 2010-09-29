<?php
class Plaza extends AppModel {
	var $name = 'Plaza';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'School' => array(
			'className' => 'School',
			'foreignKey' => 'school_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'PlazaImage' => array(
			'className' => 'PlazaImage',
			'foreignKey' => 'plaza_id',
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
		'Vote' => array(
			'className' => 'Vote',
			'foreignKey' => 'plaza_id',
			'dependent' => false
		)
	);

}
?>
