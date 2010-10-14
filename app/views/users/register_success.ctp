<h2 class="title"><?php echo __('Por favor, compruebe su correo electrónico', true); ?></h2>
<div style="margin:10px 0">
	<ul>
    	<li><?php echo __('Debes hacer un clic en el enlace que se enviará a tu email para poder completar tu registro.', true); ?></li>
	    <li><?php echo sprintf(__('Su correo electrónico fue enviado a %s', true), $email); ?></li>
	</ul>
</div>

<h2 class="title"><?php echo __('¿No recibiste ningún mail?', true); ?></h2> 
<div style="margin:10px 0">
	<ul>
	    <li><?php echo __('¿Se ha demorado más de 10 minutos? Por favor espere. A veces toma un poco de tiempo.', true); ?></li>
	    <li><?php echo __('Revisa tu carpeta de Spam por si acaso.', true); ?></li>
	    <li><?php echo sprintf(__('Trate de %s tu email.', true), $html->link(__('reenviar', true), array('action' => 'resend', $email))); ?></li>
	</ul>    
</div>
