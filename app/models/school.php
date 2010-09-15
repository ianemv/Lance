<?php
class School extends AppModel {
	var $name = 'School';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed   
	
	var $actsAs = array(
		'FileUpload'  => array(
			'image' => array(
				'required' 				=> array('add' => true, 'edit' => false),
				'directory' 			=> 'img/schools',
				'allowed_mime' 	    	=> array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png'),
				'allowed_extensions' 	=> array('.jpg', '.jpeg', '.png', '.gif'),
				'allowed_size' 			=> 2097152,
				'random_filename' 		=> true,
				'resize' 				=> false                          
			 )                               
		)
	);

	var $hasMany = array(
		'Plaza' => array(
			'className' => 'Plaza',
			'foreignKey' => 'school_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>