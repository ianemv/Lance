<?php echo $javascript->codeBlock(); ?>
	$('label.label-over').labelOver('label-over');
<?php echo $javascript->blockEnd(); ?>  
<div style="padding: 20px;">
	<h2 class="title"><?php echo sprintf(__('Login to %s', true), $appConfigurations['name']); ?></h2>             
	<div style="width:450px;float:left;">
		<fieldset>
		    <?php
		   echo $ajax->form(array('type' => 'post', 'options' => array('model' => 'User', 'url' => array('controller' => 'users', 'action' => 'login_ajax'), 'dataType' => 'json', 'success' => "$.colorbox({href:request.url});
	")));
	        echo $form->input('username', array('label' => array('text' => __('Usuario', true), 'class' => 'label-over'), 'class' => 'med'));
	        echo $form->input('password', array('label' => array('text' => __('Contraseña', true), 'class' => 'label-over'), 'class' => 'med'));
	        echo $form->input('remember_me', array('type' => 'checkbox', 'label' => __('Remember me.', true))); 
			if (!empty($redirect)) {
				echo $form->input('redirect', array('type' => 'hidden', 'value' => $redirect));
			}
	        echo $form->end('entrar.png');     
		    ?>
		</fieldset>          
	</div> 
</div>  


   


