<?php


class VotesController extends AppController {

    var $name = 'Votes'; 

	function plaza() {

	    $this->layout = 'json';
        if (!$this->RequestHandler->isAjax()) {
            $this->redirect('/');
        }

        $message = null;
        $success = false;
        $login = false;

        if ($this->Session->check('Auth.User')) {
            $this->data['user_id'] = $this->Auth->user('id');

        if (!empty($this->data)) {
            $canVote = true;
            $plaza_id = $this->data['Votes']['plaza_id'];
            $user_id = $this->data['user_id'];
            $plaza = $this->Vote->Plaza->find('first', array('conditions' => array('Plaza.id' => $plaza_id)));
            
            if (!empty($plaza)) {
                if (!empty($this->appConfigurations['limits']['active'])) {
                    $limits_exceeded = $this->Vote->limitsCanVote($plaza['Plaza']['id'], $user_id);
                    if ($limits_exceeded == false) {
                        $message = __('You cannot vote for as you have exceeded your voting limits. Try again later.', true);
                        $canVote = false;
                    }
                }

                if ((!empty($plaza['Plaza']['closed']) || (!empty($plaza['PLaza']['end_time']) && strtotime($plaza['Plaza']['end_time']) <= time()))) {
                    $message = sprintf(__('This %s is closed to voting.', true), __('Plaza', true));
                    $canVote = false;
                }
                
                if (!empty($plaza['Plaza']['start_time'])) {
                    if (strtotime($plaza['Plaza']['start_time']) > time()) {
                        $message = sprintf(__('Voting for this %s has not started yet', true), __('Plaza', true));
                        $canVote = false;
                    }
                }
            } else {
                $message = __('That plaza could not be found.  Please try again', true);
            }
            if ($canVote) {
                $vote['plaza_id'] = $plaza_id;
                $vote['user_id'] = $user_id;
                $this->Vote->create();
                if ($this->Vote->save($vote)) {
                    $message = __('Thanks for your vote', true);
                    $success = true;
                } else {
                    $message = __('There was a problem with your vote.  Please contact us', true);
                    $success = false;
                }
            } else {
                $success = false;
            }
        }
        } else {
            $message = __('You are not logged in.', true);
            $login = true;
            $success = false;
            // Not Logged In
        }

        if (!$success) {
            $this->set('message', $message);
            $message = $this->render('/elements/error');
            $this->output = "";
        } else {
            $this->set('message', $message);
            $message = $this->render('/elements/success');
            $this->output = "";
        }


        $vote = array('success' => $success, 'message' => $message, 'login' => $login);
        $this->set('data', $vote);
        $this->render('/votes/plaza');
	}

    function count() {
        $this->layout = 'ajax';
        $count = 0;
        $plaza_id = 0;
        if (!empty($this->params['url']['id'])) {
            $plaza_id = $this->params['url']['id'];
            $params = array('conditions' => array('Vote.plaza_id' => $plaza_id));
            $count = $this->Vote->find('count', $params);
        }
        $data = array('url' => $plaza_id, 'votes' => $count, 'id' => $plaza_id);
        $this->set('data', $data);
    }

}
