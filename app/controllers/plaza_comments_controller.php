<?php
class PlazaCommentsController extends AppController {

	var $name = 'PlazaComments'; 
	function beforeFilter() {
        parent::beforeFilter();

        if (!empty($this->Auth)) {
            $this->Auth->allow('post', 'comments');
        }
    }
	
	function post() {
		if (!empty($this->data)) {  
			if (!$this->Session->check('Auth.User')) {
				$this->Session->setFlash(__('You must be logged in to post a comment.', true), 'error'); 
				$this->redirect('/');
			}
			
			$user = $this->Auth->user();
			
			$this->data['PlazaComment']['user_id'] = $user['User']['id'];
	   		if ($this->PlazaComment->save($this->data)) {
		    	die('here');
			}
		}                   
		die('ther');
	} 
	
	function comments($id = null) {
		if (!empty($id)) {  
			$this->PlazaComment->recursive = 2;
			$this->PlazaComment->id = $id;              
			$comments = $this->PlazaComment->find('all');
			return $comments;
		}
	}

}
?>