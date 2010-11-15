<?php

class PagesController extends AppController {
	
	var $name = 'Pages';
	
	var $helpers = array('Recaptcha');
	
	var $components = array('Recaptcha');
	
    function beforeFilter() {
        parent::beforeFilter();

        if (!empty($this->Auth)) {    
			$this->Auth->allow('*');
            #$this->Auth->allow('activate', 'register', 'reset', 'recover', 'resend', 'login', 'logout', 'admin_recover');
        }
    }
	
	function view($slug = null) {   
		if (empty($slug)) {
			$this->Session->setFlash(__('Invalid Page', true));
			$this->redirect('/');
		}
		
		$page = $this->Page->findBySlug($slug);
		if (!empty($page)) {
			$this->set('page', $page);
		} else {
			$this->Session->setFlash(__('Invalid Page', true));
			$this->redirect('/');
		}
		$this->set('title_for_layout', $page['Page']['title']);
		if (!empty($page['Page']['meta_description'])) {
			$this->set('meta_description', $page['Page']['meta_description']);
		}
		if (!empty($page['Page']['meta_keywords'])) {
			$this->set('meta_keywords', $page['Page']['meta_keywords']);
		}
	}
	
	function contact() {
		if (!empty($this->data)) {
			if (Configure::read('Recaptcha.enabled') == false || $this->Recaptcha->isValid()) {
				$this->Page->set($this->data);
				if ($this->Page->validates()) {
					$data['Page'] = $this->data['Page'];
					$data['delivery'] = 'mail';
					$data['from'] = $this->data['Page']['first_name'].' '.$this->data['Page']['last_name'] . '<'.$this->data['Page']['email'].'>';
					$data['to'] = $this->appConfigurations['email'];
					$data['subject'] = sprintf(__('%s - Formulario de contacto', true), $this->appConfigurations['name']);
					$data['template'] = 'pages/contact';     
					$this->_sendEmail($data);
					
					$this->Session->setFlash(__('El formulario de contacto fue sometido con éxito.', true), 'success');
					$this->redirect('/contacto');
				} else {
					$this->Session->setFlash(__('Hubo un problema al enviar el formulario de contacto. Por favor, revise los siguientes errores y vuelva a intentarlo', true), 'error');
				}
			} else {
				$this->Session->setFlash(__('La forma de código de la imagen no era válido, por favor, inténtelo de nuevo.', true), 'message');
				$this->set('recaptchaError', $this->Recaptcha->error);
			}
		}
		$this->set('title_for_layout', __('Contáctanos', true));
	}
	
	function getpages($position = 'top') {
		return $this->Page->find('all', array('conditions' => 'Page.'.$position.'_show > 0', 'order' => 'Page.'.$position.'_order ASC'));
	}
	
	function home() {
		
	}
	
	function admin_index() {
		$this->set('title_for_layout', __('Pages', true));
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
	}  
	
	function admin_add() {
		if (!empty($this->data)) {
		   	if ($this->Page->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'page'), 'message/success', array('class' => 'no-margin', 'close' => true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'page'), 'message/error', array('class' => 'no-margin','close' => true));
			}
		}   
		$this->set('title_for_layout', sprintf(__('Add %s', true), 'Page'));        
	} 
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'page'), 'message/warning', array('class' => 'no-margin', 'close' => true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Page->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'page'), 'message/success', array('class' => 'no-margin', 'close' => true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'page'), 'message/error', array('class' => 'no-margin', 'close' => true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Page->read(null, $id);
		}
		$this->set('title_for_layout', sprintf(__('Edit "%s"', true), $this->data['Page']['slug']));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'Page'), 'message/warning', array('class' => 'no-margin', 'close' => true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Page->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Page'), 'message/success', array('class' => 'no-margin', 'close' => true));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(sprintf(__('Unable to delete %s', true), 'Page'), 'message/error', array('class' => 'no-margin', 'close' => true));
		}
	}
}

