<?php
class Account extends AppModel {
	var $name = 'Account';
	var $displayField = 'account_type_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
     
	var $actsAs = array(
		'FileUpload'  => array(
			'image' => array(
				'required'				=> array('add' => false, 'edit' => false),
				'directory'				=> 'img/profile',
				'allowed_mime' 	    => array('image/jpeg', 'image/jpg', 'image/gif', 'image/png'),
				'allowed_extensions' => array('.jpg', '.jpeg', '.png', '.gif'),
				'allowed_size'			=> 2097152,
				'random_filename'		=> true,
				'resize'	=> array(      
					'70' => array(
						'directory' => 'img/profile/140',
						'width'         => 140,
						'phpThumb'      => array(
							'far'   => 1,
							'bg'    => 'FFFFFF'   
						)                             
			   	    ),
				  'thumb' => array(
					'directory' => 'img/profile/140',
					'width'         => 234234,
					'phpThumb'      => array(
						'far'   => 1,
						'bg'    => 'FFFFFF'   
					)                             
		   	    ),
				'grande' => array(
					'directory' => 'img/profile/140',
					'width'         => 23,
					'phpThumb'      => array(
						'far'   => 1,
						'bg'    => 'FFFFFF'   
					)                             
		   	    )                            
				)
		    )
	    )                                                                     
	);  
	
	var $belongsTo = array(
		'AccountType' => array(
			'className' => 'AccountType',
			'foreignKey' => 'account_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Gender' => array(
			'className' => 'Gender',
			'foreignKey' => 'gender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Source' => array(
			'className' => 'Source',
			'foreignKey' => 'source_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	); 
	
	
	function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->validate = array(
        	'first_name' => array(
					'notEmpty' => array(
						'rule' => array('notEmpty'),
		    			'message' => __('Tienes que ingresar tu nombre.', true),
	   			),
			 ),
			'last_name' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __('Tienes que ingresar tu appellido.', true),
				),   
            ), 
        );
    }
 
}
?>