<div>
	<h2 class="title"><?php echo __('¿Olvidaste tu contraseña?', true); ?></h2>
    <?php
        echo $form->create('User', array('action' => 'recover'));
        echo $form->input('email', array('label' => __('E-mail', true), 'class' => 'long'));
        echo $form->end('enviarme_contrasena.png');
    ?> 
</div>

