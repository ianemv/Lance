<?php echo $form->create('User', array('action' => 'register')); ?>
<fieldset>
    <?php
        echo $form->input('username', array('label' => __('Choose a username (no spaces)', true)));
        echo $form->input('before_password', array('type' => 'password', 'label' => __('Choose a password', true))); 
        echo $form->input('retype_password', array('type' => 'password', 'label' => __('Retype a password', true)));
        echo $form->input('email', array('label' => __('Email address (must be real!)', true)));
        echo $form->input('newsletter', array('label' => __('Send me occasional update', true)));
        echo $form->input('date_of_birth', array('minYear' => $appConfigurations['Dob']['year_min'], 'maxYear' => $appConfigurations['Dob']['year_max'], 'label' => __('Date of birth', true)));
    ?> 

    <?php if (Configure::read('Recaptcha.enabled')): ?>
        <label><?php echo __('Enter the text in the image', true) ?></label>
        <?php echo $recaptcha->getHtml(!empty($recaptchaError) ? $recaptchaError : null); ?>
    <?php endif; ?> 

    <?php 
        echo $html->div('terms', __('I agree to the <a href="#">terms of use</a> and <a href="#">privacy policy</a>', true));
        echo $form->end(__('I agree, continue', true));
    ?>

</fieldset>
