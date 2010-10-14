<h2 class="title"><?php echo __('Por favor, ingresa una nueva contraseña', true); ?></h2>  
<div class="">
<p><?php echo sprintf(__('Tu nombre de usuario es "%s"', true), $user['User']['username'])?></p>

    <?php
        echo $form->create('User', array('action' => 'reset'));
        echo $form->input('password_before', array('type' => 'password', 'label' => array('text' => __('Nueva contraseña', true), 'class' => 'label-over')));
        echo $form->input('password_confirmation', array('type' => 'password', 'label' => array('text' => __('Verifica contraseña', true), 'class' => 'label-over')));
        echo $form->end('cambiar_contrasena.png');
    ?> 
</div>

