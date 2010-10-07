<?php

class PagesController extends AppController {
	
	var $name = 'Pages';
	
	var $helpers = array('Recaptcha');
	
	var $components = array('Recaptcha');
	
	function beforeFilter() {
		parent::beforeFilter();
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
	}
}

