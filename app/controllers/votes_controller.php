<?php


class VotesController extends AppController {

    var $name = 'Votes'; 
	var $uses = array();

	function vote() {
	    $this->layout = 'ajax';
        if (!$this->RequestHandler->isAjax()) {
       		$this->redirect('/');
        }

        if (!empty($this->data)) { 
            $vote = $this->Vote->vote($this->data);
            $this->set('data', $vote);
		}
        return false; 
	}
}