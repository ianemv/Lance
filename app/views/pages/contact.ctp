<div>
	<h2 class="login"><?php __('Contact us using the contact form below');?>:</h2>
	<?php echo $form->create(null, array('url' => '/contact')); ?>
	<fieldset>
	    <?php
	    echo $form->input('name', array('label' => __('Name', true)));
	    echo $form->input('email', array('label' => __('Email', true)));
	    echo $form->input('phone');
	    echo $form->input('message', array('label' => __('Enquiry', true), 'type' => 'textarea'));
	    ?>

	    <?php if(Configure::read('Recaptcha.enabled')):?>
	    	<?php echo $recaptcha->getHtml(!empty($recaptchaError) ? $recaptchaError : null);?>
	    <?php endif;?>

	    <?php echo $form->end(__('Contact Us', true));?>       
	</fieldset>
</div>





