<?php echo $javascript->codeBlock(null, array('inline' => false)); ?>
    $(document).ready(function() { 
  		$(".modal").click(function() {
			$(this).colorbox({open:true, minWidth:"600px", opacity:0.50, transition:"fade"});
		});
 		$(".plaza_image_inner a").click(function() { 
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
<h2 class="title"><?php echo __('Resultados Votación', true); ?></h2>  
<p><?php echo __('Queremos felicitar a todos los colegios que han participado activamente en el proyecto Regala Una Plaza. Los resultados fueron increíbles. Miles de niños tuvieron la oportunidad de imaginar, crear y construir con LEGOS, el sueño de su mejor plaza de juegos.', true); ?></p>  <br />  
<p><?php echo __('Nuestro ganador del concurso es el "Complejo Educacional Apumanque de La Calera". Muchas felicidades a sus pequeños grandes arquitectos ¡Su plaza será construida a escala real en Concepción, una vez que se reúnan los fondos necesarios!', true); ?></p>     <br />
<p><?php echo __('Les comunicamos que hemos hecho una adaptación en la estructura de los premios. Además de premiar a los 9 ganadores por votación del público, tendremos ahora 9 premios para los establecimientos educacionales que sean escogidos por nuestro comité de jueces. Estos ganadores serán dados a conocer el 25 de Noviembre 2010. Pueden ver la nueva estructura de los premios en el link que está más abajo.', true); ?></p>  <br />
<p><?php echo __('Todos los premios serán enviados a los respectivos colegios después de la ceremonia de premiación, que se realizará el día 06 de Diciembre en Santiago.', true); ?></p>    <br />
<p><?php echo sprintf(__('Para ver los premios y el listado de los colegios ganadores por votación del público sólo deben pulsar %s.', true), $html->link(__('aquí', true), '/files/CB_Ganadores_Votacion.pdf')); ?></p>
<p><?php echo sprintf(__('Para ver el ranking de votos para todos los instituciones sólo deben pulsar %s.', true), $html->link(__('aquí', true), '/files/CB_Ranking_Ganadores_Votacion.pdf')); ?></p>    

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


       
	<div class="plaza marco" id="plaza_<?php echo $plaza['Plaza']['id']; ?>">
  		<div class="plaza_header">
			<h3><?php echo $html->link($text->truncate($plaza['School']['name'], 25), array('controller' => 'schools', 'action' => 'view', $plaza['School']['id'])); ?></h3>
			<p><?php echo $plaza['School']['location']; ?></p>
		</div>
		<div class="plaza_content"> 
			<?php if (!empty($plaza['PlazaImage'])): ?>  
				<div class="plaza_image corner"> 
					<div class="plaza_image_inner">  
			   			<?php echo $html->link($html->image('plazas'. DS . 'vote'. DS .$plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))), '#', array('class' => 'group_'.$plaza['Plaza']['id'], 'escape' => false)); ?>  
					</div>
				</div>
			<?php endif; ?>
			
			 
			<div class="vote_box corner" style="display:none"> 
				<div class="vote_box_inner corner">
					<?php echo $html->link($html->tag('span', __('Close', true)), "#", array('class' => 'close', 'onclick' => 'return showLogin({id:'.$plaza['Plaza']['id'].'}, true);', 'escape' => false))?>
					<div class="clear"></div>
					<div class="vote_dialog">
                        <?php echo $html->tag('p', $html->tag('strong', __('Para votar, tienes que registrarte.', true))); ?>            
				  	</div>
				
					<div class="vote_form">    
						<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$plaza['Plaza']['id'])); ?> 
						<?php echo $form->hidden('Vote.plaza_id', array('value' => $plaza['Plaza']['id'] )); ?> 
						<?php echo $form->input('User.username', array('label' => array('text' => __('Usuario', true), 'class' => 'label-over'), 'id' => uniqid('username_'))) ?>
						<?php echo $form->input('User.password', array('label' => array('text' => __('Contraseña', true), 'class' => 'label-over'), 'class' => 'short ', 'id' => uniqid('password_'), 'after' => $html->tag('span', $html->link(__('¿La olvidaste?', true), array('controller' => 'users', 'action' => 'recover')), array('class' => 'hint')))) ?>  
						<div style="padding:3px 5px;">
						<?php echo $html->link($html->image('entrar.png', array('alt' => __('Ingresar', true))), '#', array('onclick' => 'return votePlaza({id:'.$plaza['Plaza']['id'].'});', 'escape' => false)); ?>  
						<?php echo $html->tag('p', sprintf(__('¿No tienes una cuenta? %s ahora.', true), $html->link(__('Regístrate', true), array('controller' => 'users', 'action' => 'register')))); ?>
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
			</div>
			<div class="plaza_footer"> 
				<?php echo $html->link($html->image('ico_escritorio.png', array('alt' => $plaza['School']['name'])), array('controller' => 'plazas', 'action' => 'description', $plaza['Plaza']['id']), array('class' => 'modal', 'escape' => false))?>
				
            	<?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), array('controller' => 'plazas','action' => 'vote', '?' => array('url' => $plaza['Plaza']['id'], 'callback' => 'votePlaza')), array('class' => 'VoteThisButton VoteWide', 'escape' => false)); ?>
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


