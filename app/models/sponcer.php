<?php
class Sponcer extends AppModel {
	var $name = 'Sponcer';
	var $displayField = 'name';


  	var $actsAs = array(
		'FileUpload'  => array(
			'image' => array(
				'required' 				=> array('add' => true, 'edit' => false),
				'directory' 			=> 'img/sponcers',
				'allowed_mime' 	    	=> array('image/jpeg', 'image/jpg', 'image/gif', 'image/png'),
				'allowed_extensions' 	=> array('.jpg', '.jpeg', '.png', '.gif'),
				'allowed_size' 			=> 2097152,
				'random_filename' 		=> true,
				'resize' 				=> false                          
			 )                               
		)
	);
	
	                                                               
}
?>
