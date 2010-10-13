<div>
	<h2 class="title"><?php echo sprintf(__('Registro con %s', true), $appConfigurations['name']); ?></h2>             
	<div style="width:450px;float:left;">
		<fieldset>
		    <?php  
				echo $form->create('User', array('action' => 'register'));         
				echo $form->input('email', array('label' => __('E-mail', true), 'class' => 'med'));  
		        echo $form->input('username', array('label' => __('Nombre usuario', true), 'class' => 'med'));
		        echo $form->input('password_before', array('type' => 'password', 'label' => __('Contraseña', true), 'class' => 'med')); 
		        echo $form->end('crear.png');
		    ?>
		</fieldset>          
	</div> 
	<div style="width:450px;float:left">

	</div>
	<div style="clear:both;"></div>  
</div>

