<?php

	if (!$test): ?>
                                                                                                
<div style="padding:20px;">
    <div class="info" style="margin: 10px 0;">
        <h2 class="title"><?php echo __('Formulario donación', true); ?></h2>
        <p style="padding: 5px 0;">
        La última semana de octubre tendremos disponible esta sección, para que puedan donar dinero para la construcción a escala real del proyecto ganador. Si de igual forma, estás interesado en hacer una donación en este momento, nos puedes contactar a través del email <a href="/contacto" >info@firstlegoleague.cl</a>. Muchas gracias
        </p>
    </div>
</div> 

<?php else: ?>
	 

<div style="padding:20px;">
    <div class="info" style="margin: 10px 0;">
        <h2 class="title"><?php echo __('Formulario de Donación', true); ?></h2>
        <p style="padding: 5px 0;">Metro cuadrado por metro cuadrado - apoyenos con una donación de 1m2 o más para la nueva plaza de juegos, y hacer realidad los sueños de los niños. Basado en las ideas de los niños ganadoras de la escuela "Complejo Educacional Apumanque - La Calera" construiremos la mejor plaza de juegos en 1.000 m2. Ayúdenos en alcanzar nuestro objetivo, de construir la plaza y donarlo a Concepción, y de esta manera devolver alegría a una de las ciudades más afectadas por el terremoto 2010. Por favor completa el siguiente formulario con tus datos y elije la cantidad de m2 que quieres donar. (mínimo 1 m2 = 25.000 pesos). Todos las transacciones serán realizados a través del pago seguro en línea de DineroMail. Muchas gracias!
        </p> 
      	<p><?php echo $html->link(__('¿Ya tienes una cuenta?', true), array('controller' => 'users', 'action' => 'login'), array('onclick' => 'colorbox({width:525,opacity:0.55, onComplete:function(){$(\'.required label\').labelOver(\'label-over\');}});')); ?></p>
    </div>     
<?php
    echo $ajax->form(array('type' => 'post', 'options' => array('id' => 'formDonation', 'model' => 'Donation', 'url' => array('controller' => 'donations', 'action' => 'donate'), 'dataType' => 'json', 'success' => "
if (request.valid) {    
	$.colorbox({width: '500px', height:'300px', href:request.url});
}
")));     
	echo $form->input('Account.first_name', array('label' => array('text' => __('Nombre', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0; width:400px')); 
    echo $form->input('Account.last_name', array('label' => array('text' => __('Apellido', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:400px'));

	if (!$session->check('Auth.User')): 
		echo $form->input('User.username', array('label' => array('text' => __('Nombre usuario', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:400px'));
	    echo $form->input('User.email', array('label' => array('text' => __('Tu mail', true), 'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:400px', 'class' => 'validate-email', 'id' => uniqid('email_')));  
		echo $form->input('User.password_before', array('type' => 'password', 'label' => array('text' => __('Contraseña', true), 'class' =>'label-over'), 'style' => 'margin: 0 0 10px 0;width:400px;'));      
 	endif;   

                 
    echo $form->input('quantity', array('type' => 'text', 'label' => array('text' => __('¿Cuántos metros quieres regalar?', true), 'style' => 'font-weight:bold;width:275px'), 'onkeyup' => 'updateDonation(this.value)', 'length' => 3, 'style' => 'position:static;display:inline;width:35px', 'between' => '&nbsp;', 'after' => $html->tag('span', $html->tag('strong', sprintf(__(' x $%s', true), $html->tag('span',$appConfigurations['donations']['cost'], array('id' => 'bcost')))))));
     
?>      
    <div class="input" style="padding-left:185px;margin:20px;">
        <?php echo $html->tag('span', __('Total:', true), array('class'=>'font2')); ?>
        <?php echo $html->tag('span', sprintf('$%s', $html->tag('span', '0.00', array('id' => 'tcost'))), array('class' => 'font1', 'id' => 'donation_total', 'style'=>'padding-left:55px;')); ?>
    </div>
    <div style="padding-left:75px;">
		<?php echo $form->submit('btn_donar.png'); ?>
    </div> 
	<?php echo $form->end(); ?>
</div>   
	

<?php endif; ?>