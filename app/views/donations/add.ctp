<?php
	$number->addFormat('CLP', $appConfigurations['currency']['CLP']);
	if (!Configure::read('dev')): ?>                                                                                     
<div style="width: 400px; padding:20px;">
    <div class="info" style="margin: 10px 0;">
        <h2 class="title"><?php echo __('Formulario donación', true); ?></h2>
        <p style="padding: 5px 0;">
        La última semana de octubre tendremos disponible esta sección, para que puedan donar dinero para la construcción a escala real del proyecto ganador. Si de igual forma, estás interesado en hacer una donación en este momento, nos puedes contactar a través del email <a href="/contacto" >info@firstlegoleague.cl</a>. Muchas gracias
        </p>
    </div>
</div> 
<?php else: ?>   

<div style="width:425px; padding:20px;">
    <div class="info" style="margin: 10px 0;">
        <h2 class="title"><?php echo __('Formulario de Donación', true); ?></h2>
        <p style="padding: 5px 0;"><strong>M<sup>2</sup> X M<sup>2</sup></strong></p>
		<p>¡Ayúdanos a contruir una nueva plaza de juegos y así hacer realidad el sueño de miles de niños!</p>
        <p>Basándonos en las ideas de los alumnos de la escuela “Complejo Educacional Apumanque” de la Calera, ganadores del concurso Charitybox, construiremos, en 1000 m2, la MEJOR plaza de juegos y la donaremos a Concepción. Nuestro objetivo es devolverle la alegría a una de las zonas más afectadas por el terremoto.</p>  
		<p><strong>¡Dona un metro cuadro o más, completando el siguiente formulario!</strong></p>
		<p class="note">*Todas las transacciones serán realizadas a través del método de Pago Seguro en Línea de DineroMail (donación mínima un metro cuadrado = $25.000)</p>
	   	<p><strong>Un metro cuadro: Un sueño!</strong></p>
 		<?php if (!$session->check('Auth.User')): ?>
		<?php $meter = ($meter)?$meter:null?>
      	<p><?php echo $html->link(__('¿Ya tienes una cuenta?', true), array('controller' => 'users', 'action' => 'login_ajax', '?' => array('redirect' => $html->url(array('controller' => 'donations', 'action' => 'add', $meter)))), array('onclick' => '$(this).colorbox({width:525,opacity:0.55, onComplete:function(){$(\'.required label\').labelOver(\'label-over\');}});')); ?></p>  
		<?php endif; ?>
    </div>     
<?php 
    echo $ajax->form(array('type' => 'post', 'options' => array('id' => 'formDonation', 'model' => 'Donation', 'url' => array('controller' => 'donations', 'action' => 'donate'), 'dataType' => 'json', 'success' => "
if (request.valid) {    
	$.colorbox({width: '500px', height:'300px', href:request.url});
}
"))); 
	if (!empty($meter)):
   		echo $form->input('DonationMeter.0.meter', array('type' => 'hidden', 'value' => $meter)); 
	endif;
	echo $form->input('Account.first_name', array('label' => array('text' => __('Nombre', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0; width:425px')); 
    echo $form->input('Account.last_name', array('label' => array('text' => __('Apellido', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:425px'));

	if (!$session->check('Auth.User')): 
		echo $form->input('User.username', array('label' => array('text' => __('Nombre usuario', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:425px'));
	    echo $form->input('User.email', array('label' => array('text' => __('Tu mail', true), 'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:425px', 'class' => 'validate-email', 'id' => uniqid('email_')));  
		echo $form->input('User.password_before', array('type' => 'password', 'label' => array('text' => __('Contraseña', true), 'class' =>'label-over'), 'style' => 'margin: 0 0 10px 0;width:425px;'));      
   	endif; 
		echo $form->input('User.redirect', array('type' => 'hidden', 'value' => $html->url(array('controller' => 'donations', 'action' => 'donate', $meter))));
    ?>   
	<div class="corner" style="padding: 10px; margin: 10px 0; border: 3px dashed #666">
    <?php  
    	echo $form->input('quantity', array('type' => 'text', 'label' => array('text' => __('¿Cuántos metros quieres regalar?', true), 'style' => 'font-weight:bold;width:275px'), 'onkeyup' => 'updateDonation(this.value)', 'length' => 3, 'style' => 'position:static;display:inline;width:35px', 'between' => '&nbsp;', 'after' => $html->tag('span', $html->tag('strong', sprintf(__(' x $%s', true), $html->tag('span',$number->currency($appConfigurations['donations']['cost'], 'CLP'), array('id' => 'bcost')))))));
     
?>      
    	<div class="input" style="padding-left:165px;margin:20px;">
	        <?php echo $html->tag('span', __('Total:', true), array('class'=>'font2')); ?>
	        <?php echo $html->tag('span', sprintf('$%s', $html->tag('span', $number->currency('0.000', 'CLP'), array('id' => 'tcost'))), array('class' => 'font1', 'id' => 'donation_total', 'style'=>'padding-left:55px;')); ?>
	    </div>    
	</div>
    <div style="padding-left:75px;">
		<?php echo $form->submit('btn_donar.png'); ?>
    </div> 
	<?php echo $form->end(); ?>
</div>   
	

<?php endif; ?>