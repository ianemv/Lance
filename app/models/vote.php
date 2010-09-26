<?php
class Vote extends AppModel {
	var $name = 'Vote';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Plaza' => array(
			'className' => 'Plaza',
			'foreignKey' => 'plaza_id',
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
		)
	);


    function limitsCanVote($plaza_id = null, $user_id = null) {
        $expiry_date = date('Y-m-d H:i:s', time() - ($this->appConfigurations['limits']['expiry'] * 24 * 60 * 60));

        $params = array('conditions' => array('Vote.user_id' => $user_id, 'Vote.plaza_id' => $plaza_id, 'Vote.created >' => $expiry_date));

        if ($this->find('count', $params) >= $this->appConfigurations['limits']['limit']) {
            return false;
        }
        return true;
    }


}
?>
