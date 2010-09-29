<div>
	<h2 class="login"><?php echo __('Contactano usando el formulario abajo', true);?>:</h2>
	<?php echo $form->create(null, array('url' => '/contact')); ?>
	<fieldset>
	    <?php
	    echo $form->input('name', array('label' => __('Nombre', true)));
	    echo $form->input('email', array('label' => __('Mail', true)));
	    echo $form->input('phone', array('label' => __('Fono', true)));
	    echo $form->input('message', array('label' => __('Mensaje', true), 'type' => 'textarea'));
	    ?>

	    <?php if(Configure::read('Recaptcha.enabled')):?>
	    	<?php echo $recaptcha->getHtml(!empty($recaptchaError) ? $recaptchaError : null);?>
	    <?php endif;?>

	    <?php echo $form->end();?>       
	</fieldset>
</div>





