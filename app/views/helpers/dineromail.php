<?php
	class DineromailHelper extends Helper {
		function submit($buttonName = 'Submit', $data = array()) {
			$result = '<form id="frmDineroMail" name="frmDineroMail" action="' .$data['url'] . '" method="post">';
			foreach ($data as $name => $value) {
				if (!$data != 'url') {
					$result .= '<input type="text" name="' . $name . '" value="' . $value . '" />';
				}
			} 
			if (!empty($buttonName)) {                                                                                      
				$result .= '<div class="submit"><input type="submit" value="'.$buttonName.'" /></div>';  
			}
			$result .= '</form>';
			return $this->output($result);
		}
	}