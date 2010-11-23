<?php


App::import('Core', 'Xml');     
App::import('Core', 'HttpSocket');
class DineromailComponent extends Object {
	       
	var $config = array();
	var $targetUrl = 'https://chile.dineromail.com/Vender/Consulta_IPN.asp'; 
	var $result = null;
	var $ipn_data = null;
	
	var $xml;
	
	function configure($config = null) { 
		$this->config = $config; 
		if (!empty($_POST)) {
			if (!empty($_POST['Notificacion'])) {
				$this->xml = new Xml($_POST['Notificacion']);
			}
		}
	}
	
	function validate_ipn() {
		if (!empty($this->xml)) {  
			$notificacion = $this->xml->toArray();  
			if (!empty($notificacion['Notificacion'])) {  
				$data = array();   
		    	foreach ($notificacion['Notificacion']['Operaciones'] as $key => $value) {  
					if (!empty($value['id'])) { 
						$data[]['ID'] = $value['id'];
					} else {	
				   		foreach ($value as $val) {
					    	$data[]['ID'] = $val['id'];
						}
					}
				}  
				$this->_makeRequest($data);
				if (!empty($this->result)) { 
					if (!empty($this->result['REPORTE']) && $this->result['REPORTE']['ESTADOREPORTE'] == 1) {
						$result = $this->result['REPORTE']['DETALLE'];  
					   	foreach ($result['OPERACIONES'] as $key => $operacions) {
							if (!empty($operacions['ID'])) {
								$this->ipn_data['OPERACIONES'][$key][] = $operacions;
							} else {
								$this->ipn_data['OPERACIONES']['OPERACION'] = $operacions;
							}
						}   
						return true;
					}
				}     
			}
		}               
		return false;
	} 
	
	
	function _createConnection($targetUrl) {
		$conn = new HttpSocket();
		if (!$conn) {
			$this->log(sprintf(__('Error create connection to %s', true), $targetUrl));
			return false;
		}                                                                             
		return $conn;
	}  
	
	
	function _sendRequest($data, $conn) {
		if ($conn !== false) {
			$results = $conn->post($this->targetUrl, $data);
			if ($results) {
				$result = new Xml($results);                               
			   	if (!empty($results)) {
					$this->result = $result->toArray();
			 	}
			}
		}
	}
	  
	function _makeRequest($operaciones = null) {  
		
		if (!empty($operaciones)) { 
			$reporte = '<REPORTE><NROCTA>'.$this->config['merchant'].'</NROCTA>';
			$reporte .= '<DETALLE><CONSULTA><CLAVE>'.$this->config['password'].'</CLAVE>';
			$reporte .= '<TIPO>1</TIPO>';
			$reporte .= '<OPERACIONES>';
			if (!empty($operaciones)) {
				foreach ($operaciones as $operacion) {
					$reporte .= '<ID>'.$operacion['ID'].'</ID>';
				}
			}
			$reporte .= '</OPERACIONES></CONSULTA></DETALLE></REPORTE>';       
			$this->_sendRequest(array('data' => $reporte), $this->_createConnection($this->targetUrl));
		}
		
	}
}