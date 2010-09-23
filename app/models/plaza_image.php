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
				'allowed_mime' 	  	=> array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'),
				'allowed_extensions'=> array('.jpg', '.jpeg', '.png', '.gif'),
                'allowed_size'      => 3276800,
                'random_filename'   => false,
                'resize' => array( 
					'preview' => array(
		                'directory' => 'img/plazas/preview',
		                'width' => 175,
		                'height' => 140,
		                'phpThumb' => array(
		                    'zc' => 1, 
							'fltr' => array(
								'ric|10|10'
							)
		                )
		            ),
		            'thumb' => array(
		                'directory' => 'img/plazas/thumbs',
		                'width' => 45,
		                'height' => 45,
		                'phpThumb' => array(
		                    'zc' => 1
		                )
		            )
		        )
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
