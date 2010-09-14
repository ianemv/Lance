<?php
class PlazaImage extends AppModel {
	var $name = 'PlazaImage';
	var $displayField = 'image';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
    
    var $actsAs = array(
        'FileUpload' => array(
            'image' => array(
                'required'          => array('add' => true, 'edit' => false),
                'directory'         => 'img/plazas',
                'allowed_mime'      => array('image/jpg', 'image/jpeg'),
                'allowed_extensions'=> array('.jpg', '.jpeg'),
                'allowed_size'      => 2097152,
                'random_filename'   => false,
                'resize'            => false,
            )
        )
    );

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
