<?php echo $javascript->codeBlock(); ?>
	$('label').labelOver('label-over');    
	
	function processForm(request) {
		if (request == 'success') {
			
		}
	}
<?php echo $javascript->blockEnd(); ?>
<div class="info" style="margin: 10px 0;">
    <h2 style="border-bottom: 1px dotted #666;padding:5px 5px;"><?php echo __('Donacion ', true); ?></h2>
    <p style="padding: 5px 0;"><?php echo __('Ayudan a realizar este sueño', true); ?></p>
</div>

<?php
    echo $ajax->form(array('type' => 'post', 'options' => array('id' => 'formDonation', 'model' => 'Donation', 'url' => array('controller' => 'donations', 'action' => 'donate'), 'dataType' => 'json', 'success' => 'processForm(request);')));
    echo $form->input('first_name', array('label' => __('Nombre', true),'class' => 'label-over')); 
    echo $form->input('last_name', array('label' => __('Apellido', true),'class' => 'label-over'));
    echo $form->input('email', array('label' => __('Mail', true),'class' => 'label-over'));
    echo $form->end('Submit'); 
?>      

