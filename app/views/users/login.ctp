<?php echo $javascript->codeBlock(); ?>
	function processForm(request) {
		if (request == 'success') {
			
		}
	}
    $(document).ready(function() {
        $('label.label-over').labelOver('label-over');
    });
<?php echo $javascript->blockEnd(); ?>  
<div>
	<h2 class="title"><?php echo sprintf(__('Login to %s', true), $appConfigurations['name']); ?></h2>             
	<div style="width:450px;float:left;">
		<fieldset>
		    <?php   
			echo $form->create('User', array('controller' => 'users', 'action' => 'login'));
	        echo $form->input('username', array('label' => array('text' => __('Usuario', true), 'class' => 'label-over'), 'class' => 'med'));
	        echo $form->input('password', array('label' => array('text' => __('Contraseña', true), 'class' => 'label-over'), 'class' => 'med'));
	        echo $form->input('remember_me', array('type' => 'checkbox', 'label' => __('Remember me.', true)));
	        echo $form->end('entrar.png');     
		    ?>
		</fieldset>          
	</div> 
	<div style="width:450px;float:left">
    	<h2><?php echo __('No tienes una cuenta?', true); ?></h2>
		<p><?php echo sprintf(__('Es facil! Solo %s ahora!', true), $html->link(__('Regístrate', true), array('action' => 'register'))); ?> </p>
	</div>
	<div style="clear:both;"></div>  
</div>  


   


