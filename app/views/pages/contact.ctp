<div>
	<h2 class="title login"><?php echo __('Contáctanos llenando el formulario', true);?>:</h2>
	<div style="width:450px;float:left;">
		<fieldset>
		    <?php   
		 	echo $form->create(null, array('url' => '/contacto'));       
		    echo $form->input('first_name', array('label' => __('Nombre', true))); 
			echo $form->input('last_name', array('label' => __('Apellido', true))); 
		    echo $form->input('email', array('label' => __('Mail', true)));
		    echo $form->input('phone', array('label' => __('Teléfono', true)));
		    echo $form->input('message', array('label' => array('text' => __('Mensaje', true), 'class' => 'label-over'), 'type' => 'textarea'));
		    ?>

		    <?php if(Configure::read('Recaptcha.enabled')):?>
		    	<?php echo $recaptcha->getHtml(!empty($recaptchaError) ? $recaptchaError : null);?>
		    <?php endif;?>

		    <?php echo $form->end('contactanos.png');?>       
		</fieldset>          
	</div> 
	<div style="width:450px;float:left">
		<address>   
			<strong>Fundación Gabriel y Mary Mustakis</strong><br /> Av. Presidente Riesco 5335, of. 303,<br /> La Condes, Santiago<br /> <a href="http://www.fundacionmustakis.com">http://www.fundacionmustakis.com</a>
		</address>
	</div>
	<div style="clear:both;"></div>  
</div>  






