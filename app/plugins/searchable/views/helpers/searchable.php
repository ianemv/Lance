<?php
class SearchableHelper extends AppHelper {
  var $helpers = array('Html', 'Text');
  function snippets($data) { 
	$data = json_decode($data, true);
	$term = trim($this->data['SearchIndex']['term']);
	$snippets = '';
  	foreach ($data as $value) {  
		if (strlen($snippets) < 255) {
			$snippets .= $this->Text->highlight($this->Text->excerpt($this->_createSnippet($value), 20), $term);  
		}
	}
  	return $snippets;
  }

  private function _createSnippet($value) {  
	if (is_array($value)) { 
		foreach ($value as $val) {
			return $this->_createSnippet($val);
		}
	} else {
	 	return $value;
	}                                          
  }
}
?>
