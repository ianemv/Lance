<?php
class School extends AppModel {
	var $name = 'School';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed   
	
	var $actsAs = array( 
		'Searchable.Searchable' => array(
			'summary' => 'location',
		),
		'FileUpload'  => array(
			'image' => array(
				'required' 				=> array('add' => false, 'edit' => false),
				'directory' 			=> 'img/schools',
				'allowed_mime' 	    	=> array('image/jpeg', 'image/jpg', 'image/gif', 'image/png'),
				'allowed_extensions' 	=> array('.jpg', '.jpeg', '.png', '.gif'),
				'allowed_size' 			=> 3276800,
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

    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

        $this->validate = array(
            'name' => array(
				'notEmpty' => array(
					'rule' => array('notEmpty'),
					'message' => __('School name must not be empty.', true),
                    'last' => true
				),
                'isUnique' => array(
                    'rule' => array('isUnique' , 'name'),
                    'message' => __('School name is already taken.', true),
                ), 
            ),
            'key' => array(
                'isUnique' => array(
                    'rule' => array('isUnique', 'key'),
                    'message' => __('It looks like this school has been added.  Check the ID and try again.', true),
                    'required' => false,
                ),
            ),
            'location' => array(
                'notEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => __('Please enter a location for this school.', true)
                ),
            ) 
        );
    }
}
?>
