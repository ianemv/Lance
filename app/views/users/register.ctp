<div>
	<h2 class="title"><?php echo sprintf(__('Regístrate con %s', true), $appConfigurations['name']); ?></h2>             
	<div style="width:450px;float:left;">
		<fieldset>
		    <?php  
				echo $form->create('User', array('action' => 'register'));         
				echo $form->input('email', array('label' => __('E-mail', true), 'class' => 'med'));  
		        echo $form->input('username', array('label' => __('Usuario', true), 'class' => 'med'));
		        echo $form->input('before_password', array('type' => 'password', 'label' => __('Contraseña', true), 'class' => 'med')); 
		        echo $form->end('crear.png');
		        echo $html->div('terms hint', sprintf(__('Al crear una cuenta usted de acuerdo con los %s & %s ', true), $html->link(__('Términos de Servicio', true), '#'), $html->link(__('Política de Privacidad', true), '#')));
		    ?>
		</fieldset>          
	</div> 
	<div style="width:450px;float:left">

	</div>
	<div style="clear:both;"></div>  
</div>

