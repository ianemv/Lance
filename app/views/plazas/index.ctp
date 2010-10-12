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
<h2 class="title"><?php echo __('Vota por tu plaza favorita', true); ?></h2>  
<p>A continuación puedes votar a través de estas fotos por la plaza que más te guste de las que construyeron los niños.
Solo haz “click” en tu(s) plaza(s) favorita(s) e ingresa tus datos ¡Tienes hasta el 02 de Noviembre para votar! 
</p><br />

<p>IMPORTANTE: Cada persona tiene un máximo de 10 votos. Si quieres ver la descripción de la plaza, haz click en el ícono de texto, ubicado bajo la foto. Para ver las fotos más grandes, haz click en ellas.</p> <br />

<p>Son ustedes los que eligen el proyecto ganador y los que dan la oportunidad de hacer realidad los sueños de los niños: construir a escala real en 1.000m² en Concepción el proyecto ganador de "Mi mejor plaza de juegos".</p><br />  
<p>Además los 9 proyectos más votados recibirán premios LEGO Educación, equivalente a un total de $11.000.000.</p><br />  
<p>Con respecto a la participación de los jardines infantiles: Si es que alguno se encuentra dentro de los 10 más votados tendrá un premio especial acorde a la edad de los niños, pero no podrá optar por los premios originales, incluida la construcción a escala real de la plaza, por encontrarse los niños fuera del rango de edad del concurso.</p><br />

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
						<?php echo $html->tag('p', sprintf(__('No tienes una cuenta? %s.', true), $html->link(__('Crear una', true), array('controller' => 'users', 'action' => 'register')))); ?>
				  	</div>
					<div class="vote_form">    
						<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$plaza['Plaza']['id'])); ?> 
						<?php echo $form->hidden('Vote.plaza_id', array('value' => $plaza['Plaza']['id'] )); ?> 
						<?php echo $form->input('User.username', array('label' => array('text' => __('Usuario', true), 'class' => 'label-over'), 'id' => uniqid('email_'))) ?>
						<?php echo $form->input('User.password', array('label' => array('text' => __('Contraseña', true), 'class' => 'label-over'), 'class' => 'short ', 'id' => uniqid('password_'), 'after' => $html->tag('span', $html->link(__('Olvidaste?', true), array('controller' => 'users', 'action' => 'recover')), array('class' => 'hint')))) ?>  
					   	
						<?php #echo $form->input('User.first_name', array('label' => array('text' => __('Nombre', true), 'class' => 'label-over'), 'id' => uniqid('nombre_')))?>
						<?php #echo $form->input('User.last_name', array('label' => array('text' => __('Apellido', true), 'class' => 'label-over'), 'id' => uniqid('apellido_')))?>                                   
                        <?php #echo $form->input('User.email', array('label' => array('text' => __('Mail', true), 'class' => 'label-over'), 'class' => 'validate-email', 'id' => uniqid('mail_'))); ?>    
                 		<?php #$html->image('btn_entrar_plaza.png', array('alt' => __('Entrar', true))) ?>
						<?php #$html->image('btn_registrarte_plaza.png', array('alt' => __('Regístrate', true)))?>  
						<div style="margin:10px 0;">
						<?php echo $html->link($html->image('entrar.png', array('alt' => __('Ingresar', true))), '#', array('onclick' => 'return votePlaza({id:'.$plaza['Plaza']['id'].'});', 'escape' => false)); ?>  
						<?php echo $html->tag('p', sprintf(__('No tienes una cuenta? %s.', true), $html->link(__('Crear una', true), array('controller' => 'users', 'action' => 'register')))); ?>
						</div>  
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


