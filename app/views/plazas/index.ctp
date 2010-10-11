<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() { 
		$(".plaza_img").corner(); 
        $(".vote_box").corner();
  		$(".modal").click(function() {
			$(this).colorbox({open:true, minWidth:"600px", opacity:0.50, transition:"fade"});
		});
 		$(".plaza_img_inner a").click(function() { 
	     	var b = "plaza_"+$(this).attr('class');   
			$('a[rel="'+b+'"]').colorbox({
				current:"<?php echo __('imagen', true); ?> {current} <?php echo __('de', true); ?> {total}", 
				open:true, 
				maxWidth:"800px", 
				opacity:0.50, 
				transition:"fade"
		  	});
			return false;
		})
    }); 
<?php echo $javascript->blockEnd(); ?>
<h2><?php echo __('Vota por tu plaza favorita', true); ?></h2>  
<p>A continuación presentamos las fotos de las plazas que los niños construyeron. Para votar tienes que hacer clic en tu plaza(s) favorita(s) e ingresar tus datos, tienes hasta el 24 de Octubre para votar. Cada persona tiene un máximo de 3 votos por día. Después de 24 horas puedes volver a votar nuevamente.  Las plazas seran ordenados por las que tienen más votos.  
</p><br />

<p>Si quieres ver la descripción de la plaza, solo debes hacer un clic en el ícono del texto, ubicado abajo de la foto. Para ver las fotos de la plaza más grandes, haga clic en ellas.</p> <br />

<p>Son ustedes los que eligen el proyecto ganador y los que dan la oportunidad de hacer realidad los sueños de los niños: Poder construir a escala real en 1.000m² en Concepción, una de las zonas afectadas por el terremoto, el proyecto ganador de "Mi mejor plaza de juegos". Además los 9 proyectos más votados recibirán premios de LEGO Educación, evaluados en un valor total sobre los $11.000.000.</p><br />

<p><strong>¡Vota por tu plaza favorita ahora!</strong></p>    

<div id="votacion_container_full"> 
     <div class="pagination">
        	<?php echo $this->Paginator->first($html->image('btn-first.png', array('alt' => __('First', true))), array('escape' => false)); ?>
        	<?php echo $this->Paginator->prev($html->image('btn-previous.png', array('alt' => __('Previous', true))), array('class' => 'disabled','escape' => false)); ?>
        	<?php echo $this->Paginator->numbers(array('class' => 'number', 'separator' => '')); ?>
        	<?php echo $this->Paginator->next($html->image('btn-next.png', array('alt' => __('Next', true))), array('class' => 'disabled', 'escape' => false)); ?>
        	<?php echo $this->Paginator->last($html->image('btn-last.png', array('alt' => __('Last', true))), array('escape' => false)); ?>
    </div>   
	<div id="plazas_list">
<?php   
	if (!empty($plazas)) {
		foreach ($plazas as $plaza) {   
?>
	<div class="marco" id="plaza_<?php echo $plaza['Plaza']['id']; ?>"> 
		<div class="clipwrapper">
			<div class="clip">   
				<h3><?php echo TextHelper::truncate($plaza['School']['name'], 25); ?></h3>
				<p><?php echo $plaza['School']['location']; ?></p>                                                               
				<?php if (!empty($plaza['PlazaImage'])): ?>  
					<div class="plaza_img"> 
						<div class="plaza_img_inner">  
				   			<?php echo $html->link($html->image('plazas'. DS . 'preview'. DS .$plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))), '#', array('class' => 'group_'.$plaza['Plaza']['id'], 'escape' => false)); ?>  
						</div>
					</div>
				<?php endif; ?>
				<div class="vote_box" style="display:none">
					<?php echo $html->link($html->tag('span', __('Close', true)), "#", array('class' => 'close', 'onclick' => 'return showLogin({id:'.$plaza['Plaza']['id'].'}, true);', 'escape' => false))?> 
					<div class="clear"></div>
					<div class="vote_dialog">
                        <?php echo $html->tag('p', $html->tag('strong', __('Para votar, tienes que entrar.', true))); ?>            
						<?php echo $html->tag('p', sprintf(__('No tienes un cuenta? %s.', true), $html->link(__('Crear una', true), array('controller' => 'users', 'action' => 'register'), array('class' => 'modal')))); ?>
				  	</div>
					<div class="vote_form">    
						<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$plaza['Plaza']['id'])); ?> 
						<?php echo $form->hidden('Vote.plaza_id', array('value' => $plaza['Plaza']['id'] )); ?> 
						<?php echo $form->input('User.email', array('label' => array('text' => __('E-mail', true), 'class' => 'label-over'), 'id' => uniqid('email_'))) ?>
						<?php echo $form->input('User.password', array('label' => array('text' => __('Contraseña', true), 'class' => 'label-over'), 'id' => uniqid('password_'))) ?>  
					   	<?php echo $form->input('User.remember_me', array('type' => 'checkbox', 'label' => __('Recordarme', true), 'id' => uniqid('remember_'))); ?>
						<?php #echo $form->input('User.first_name', array('label' => array('text' => __('Nombre', true), 'class' => 'label-over'), 'id' => uniqid('nombre_')))?>
						<?php #echo $form->input('User.last_name', array('label' => array('text' => __('Apellido', true), 'class' => 'label-over'), 'id' => uniqid('apellido_')))?>                                   
                        <?php #echo $form->input('User.email', array('label' => array('text' => __('Mail', true), 'class' => 'label-over'), 'class' => 'validate-email', 'id' => uniqid('mail_'))); ?>    
                 		<?php #$html->image('btn_entrar_plaza.png', array('alt' => __('Entrar', true))) ?>
						<?php #$html->image('btn_registrarte_plaza.png', array('alt' => __('Regístrate', true)))?>
						<?php echo $html->link('Login', '#', array('onclick' => 'return votePlaza({id:'.$plaza['Plaza']['id'].'});', 'escape' => false)); ?>
						<?php echo $html->link('Regester', array('controller' => 'users', 'action' => 'register'), array('class' => 'modal', 'escape' => false)); ?>
						
						<?php echo $form->end();?> 
					</div> 
                    <?php if (!empty($plaza['PlazaImage'])): ?>  
						<div class="plaza_thumb"> 
						<?php echo $html->image('plazas' . DS . 'thumbs' . DS . $plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))); ?>  
						</div>
						<div class="plaza_group">  
						<?php foreach ($plaza['PlazaImage'] as $image): ?> 
							<?php echo $html->tag('p', $html->link($plaza['School']['name'], '/img/plazas' . DS . $image['image'], array('rel' => 'plaza_group_'.$plaza['Plaza']['id'], 'title' => $plaza['School']['name'])))?>
						<?php endforeach; ?> 
						</div>  
					<?php endif; ?>   
			  	</div>  
			  	<div class="vote_bottom"> 
					<ul>
						<li class="plaza_info"><?php echo $html->link($html->tag('span', __('Plazas', true)), array('controller' => 'plazas', 'action' => 'description', $plaza['Plaza']['id']), array('escape' => false, 'class' => 'modal')); ?></li>
					</ul>
					
                <?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), array('controller' => 'plazas','action' => 'vote', '?' => array('url' => $plaza['Plaza']['id'], 'callback' => 'votePlaza')), array('class' => 'VoteThisButton VoteWide', 'escape' => false)); ?>
				</div>  
				
			</div>
		</div>  
		
	</div>	  
<?php		
		}                     
	} else {
		echo __('Encontró Ningún Plaza.', true);
	}     
	?>    
	<div class="clear"></div>
	</div>  
	<div class="pagination">
		<?php echo $this->Paginator->first($html->image('btn-first.png', array('alt' => __('First', true))), array('escape' => false)); ?>
	 	<?php echo $this->Paginator->prev($html->image('btn-previous.png', array('alt' => __('Previous', true))), array('class' => 'disabled','escape' => false)); ?>
	 	<?php echo $this->Paginator->numbers(array('class' => 'number', 'separator' => '')); ?>
	 	<?php echo $this->Paginator->next($html->image('btn-next.png', array('alt' => __('Next', true))), array('class' => 'disabled', 'escape' => false)); ?>
	 	<?php echo $this->Paginator->last($html->image('btn-last.png', array('alt' => __('Last', true))), array('escape' => false)); ?>
	</div>
</div>  


