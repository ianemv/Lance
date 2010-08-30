<?php
class DonationsController extends AppController {

	var $name = 'Donations';

    function donate() {
        $this->layout = 'ajax';
        if (!$this->RequestHandler->isAjax()) {
            $this->redirect('/');
        }
        if (!empty($this->data)) {
            if ($this->Donation->donate($this->data)) {
                
            }
		}



    }
}
?>
