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
	 
<?php echo $javascript->codeBlock(null, array('inline' => false)); ?>
    $(document).ready(function() {
        $('label.label-over').labelOver('label-over');
        $('input #DonationAmount').blur(function() {
        alert($(this).val());
        });
    });
<?php echo $javascript->blockEnd(); ?>
<div style="padding:20px;">
    <div class="info" style="margin: 10px 0;">
        <h2 class="title"><?php echo __('Ayudanos donando', true); ?></h2>
        <p style="padding: 5px 0;"><?php echo __('Ayudan a realizar este sueño', true); ?>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit scelerisque nunc, et viverra ligula tempus sit amet. Nam arcu tellus, pulvinar in adipiscing non, sodales id ante. Pellentesque placerat metus non quam lobortis quis posuere dolor feugiat. Maecenas justo nibh, suscipit facilisis rhoncus sed, varius at velit.
        </p>       
    </div>     
<?php
    echo $ajax->form(array('type' => 'post', 'options' => array('id' => 'formDonation', 'model' => 'Donation', 'url' => array('controller' => 'donations', 'action' => 'donate'), 'dataType' => 'json', 'success' => "
if (request.valid) {
	$.colorbox({width: '500px', height:'300px', href:'".$html->url(array('controller' => 'payment_gateways', 'action' => 'dineromail', 'donation'))."'});
}
")));     
	echo $form->input('Account.first_name', array('label' => array('text' => __('Nombre', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0; width:400px')); 
    echo $form->input('Account.last_name', array('label' => array('text' => __('Apellido', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:400px'));

	if (!$session->check('Auth.User')): 
		echo $form->input('User.username', array('label' => array('text' => __('Nombre usuario', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:400px'));
	    echo $form->input('User.email', array('label' => array('text' => __('Tu mail', true), 'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:400px', 'class' => 'validate-email', 'id' => uniqid('email_')));  
		echo $form->input('User.password_before', array('type' => 'password', 'label' => array('text' => __('Contraseña', true), 'class' =>'label-over'), 'style' => 'margin: 0 0 10px 0;width:400px;'));      
 	endif;   

                 
    echo $form->input('amount', array('type' => 'text', 'label' => array('text' => __('¿Cuántos metros quieres regalar?', true), 'style' => 'font-weight:bold;width:275px'), 'length' => 3, 'style' => 'position:static;display:inline;width:35px', 'between' => '&nbsp;', 'after' => $html->tag('span', $html->tag('strong', sprintf(__(' x $%s', true), $appConfigurations['donations']['cost'])))));
     
?>      
    <div class="input" style="padding-left:185px;margin:20px;">
        <?php echo $html->tag('span', __('Total:', true), array('class'=>'font2')); ?>
        <?php echo $html->tag('span', '$0,000', array('class' => 'font1', 'id' => 'donation_total', 'style'=>'padding-left:55px;')); ?>
    </div>
    <div style="padding-left:75px;">
		<?php echo $form->submit('btn_donar.png'); ?>
    </div> 
	<?php echo $form->end(); ?>
</div>   
	

<?php endif; ?>

