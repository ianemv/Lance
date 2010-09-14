<?php echo $javascript->codeBlock(); ?>
function processForm(request) {
    $.each(request.errors, function(key, value) {
        <!-- $('#'+key).parent('.input').addClass('error'); 
        $('#'+key).html(value); -->
    });
}
<?php echo $javascript->blockEnd(); ?>
<div class="info" style="margin: 10px 0;">
    <h2 style="border-bottom: 1px dotted #666;padding:5px 5px;"><?php echo __('Donation Form', true); ?></h2>
    <p style="padding: 5px 0;"><?php echo __('Please fill out the form and donate to our cause', true); ?></p>
</div>

<?php
    echo $ajax->form(array('type' => 'post', 'options' => array('id' => 'formDonation', 'model' => 'Donation', 'url' => array('controller' => 'donations', 'action' => 'donate'), 'dataType' => 'json', 'success' => 'processForm(request)')));
    echo $form->input('first_name', array('label' => __('First Name', true))); 
    echo $form->input('last_name', array('label' => __('Last Name', true)));
    echo $form->input('rut', array('label' => __('RUT', true)));
    echo $form->input('email', array('label' => __('Email', true)));
    echo $form->input('twitter', array('label' => __('Twitter', true)));
    echo $form->input('message', array('type' => 'textbox', 'label' => __('Message', true)));
    echo $form->end('Submit'); 

    echo $ajax->observeField('DonationRut', array(
        'url' => array('action' => 'checkRut'),
        'complete' => 'alert(request.responseText)'
        )
    );
?>

