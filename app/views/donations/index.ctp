<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() { 
	    $(".transfer img").css({ 'opacity' : 0.0 });
        $('#votacion_container_right .marcddo').hoverIntent(
           function() {  
	 		   var plazaImg = $(this).find('.plaza_img');
			   var thumbRel = $(this).find('.plaza_img img').attr('rel');
			   $(plazaImg).fadeOut();
               $(this).find(".vote_box").effect('slide', {direction:'up'}, 200).effect('transfer', {to: $(".plaza_thumb img[rel='"+thumbRel+"']")}, 500); 
			   $(this).find('.vote_dialog').effect('bounce', {direction:'down'},200);   
			   $(".plaza_thumb img[rel='"+thumbRel+"']").animate({opacity: 1.0}, 1000); 	
           },
           function() {    
	   		   var plazaImg = $(this).find('.plaza_img');
			   var thumbRel = $(this).find('.plaza_img img').attr('rel');  
			   $(plazaImg).fadeIn();  
               $(this).find(".vote_box").fadeOut();
			   $(".plaza_thumb img[rel='"+thumbRel+"']").animate({opacity: 0.0}, 1000); 
               $(this).find(".vote_form input").val();
           }
       ); 
        $(".vote_box").corner();   
		$(".plaza_img").corner();   
		$(".plaza_img_inner").corner(); 
    }); 
 

<?php echo $javascript->blockEnd(); ?>
<?php $plazas = $this->requestAction('/plazas/getplazas/limit:6');  ?> 
<?php echo $this->element('donation'); ?>
<div id="votacion_container">
	<h2><?php echo __('Estas son algunas de las plazas', true); ?></h2>
    <?php echo $html->div('view_all', $html->link(__('ver todos', true), array('controller' => 'plazas', 'action' => 'index')), array('style' => 'float:right;margin-top:-30px;')); ?>
	<div id="votacion_container_left" class="font">
		<p>Entre junio y agosto del año 2010, fueron cientos los colegios que participaron en el concurso "Mi mejor plaza de juegos” utilizando piezas de LEGO para construir sus modelos. A continuación presentamos las fotos de las plazas que los niños del proyecto construyeron y la que obtenga más votos será construida a escala real en 1.000 m² en una de las zonas afectadas por el terremoto.</p>
		<p>Entre el 30 de Septiembre y 24 de Octubre realizaremos la votación de la mejor plaza. Cada persona tiene un máximo de 3 votos por día. Puedes volver el otro día y votar de nuevo. Para votar tienes que hacer clic en tu plaza(s) favoritas e ingresar tus datos.</p>
		<p>La votación es la etapa más importante del proyecto, dado que nos entrega el proyecto ganador. Es aquí donde todos tenemos la oportunidad de hacer realidad los sueños de los niños. Poder construir a escala real en 1.000m² el proyecto ganador de "Mi mejor plaza de juegos".</p>
		<p>Además los 9 proyectos más votados recibirán premios de LEGO Educación, evaluado en un valor total sobre los $11.000.000.</p>
		<p><strong>¡Vota por tu plaza favorita ahora!</strong></p>
		<div class="votar_button"><?php echo $html->link(__('Quiero elegir la mejor plaza de juegos', true), array('controller' => 'plazas'))?></div>
	</div>
	<div id="votacion_container_right">
		<?php   
			if (!empty($plazas)) {
				foreach ($plazas as $plaza) {
		?>
		<div class="marco" id="plaza_<?php echo $plaza['Plaza']['id']; ?>"> 
			<div class="clipwrapper">
				<div class="clip">                                                                  
					<?php if (!empty($plaza['PlazaImage'])): ?>  
						<div class="plaza_img"> 
							<div class="plaza_img_inner">  
					   			<?php echo $html->image('plazas'. DS . 'preview'. DS .$plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))); ?>  
							</div> 
							<div style="margin:-35px 0 0 5px;">
			                <?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), array('controller' => 'plazas','action' => 'vote', '?' => array('url' => $plaza['Plaza']['id'], 'callback' => 'votePlaza')), array('class' => 'VoteThisButton VoteWide', 'escape' => false)); ?>
							</div> 
						</div>
					<?php endif; ?>
					<div class="vote_box" style="display:none">
						<div class="vote_dialog">
							<?php echo $html->tag('p', sprintf(__('Ingresa tu mail para votar por esta plaza o puedes %s', true), $html->link(__('ver todas las plazas', true), array('controller' => 'plazas', 'action' => 'index')))); ?>
					  	</div>
						<div class="vote_form">    
							<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$plaza['Plaza']['id'])); ?> 
							<?php echo $form->hidden('Vote.plaza_id', array('value' => $plaza['Plaza']['id'] )); ?>    
							<?php echo $form->input('User.full_name', array('label' => array('text' => __('Nombrey Apellido', true), 'class' => 'label-over'), 'id' => uniqid('nombre_')))?>                              
	                        <?php echo $form->input('User.email', array('label' => array('text' => __('Mail', true), 'class' => 'label-over'), 'class' => 'validate-email', 'id' => uniqid('mail_'))); ?>                                  
						   	<?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), '#', array('onclick' => 'return votePlaza({id:'.$plaza['Plaza']['id'].'});','class'=> 'btn_votar','style'=>'float:left', 'escape' => false)) ?>
							<?php echo $form->end();?> 
                        </div>
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
	</div>
</div>
