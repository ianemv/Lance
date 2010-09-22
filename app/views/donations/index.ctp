<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() { 
	    $(".transfer img").css({ 'opacity' : 0.0 });
        $('#votacion_container_right .marco').hoverIntent(
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
		$("input.validate-email").keydown(function() {
			
		})
        $(".vote_box").corner();   
		$(".plaza_img").corner();   
		$('label').labelOver('label-over'); 
		$(".plaza_img_inner").corner(); 
		
		 
    }); 
 
	function vote(id) {
	   $.post('/votes/vote', $("#form_"+id).serialize(),
		function(data) {
			alert('Data Loaded: '+ data);
		});
	   
	}
<?php echo $javascript->blockEnd(); ?>
<?php $plazas = $this->requestAction('/plazas/getplazas/limit:6');  ?>
<div id="votacion_container">
	<h2><?php echo __('Estas son algunas de las plazas', true); ?></h2>
    <?php echo $html->div('view_all', $html->link(__('ver todos', true), array('controller' => 'plazas', 'action' => 'index')), array('style' => 'float:right;margin-top:-30px;')); ?>
	<div id="votacion_container_left" class="font">
		<p><?php echo sprintf(__('Entre junio y agosto del año 2010, fueron cientos los colegios que participaron en el concurso de construcción con piezas de Lego para realizar "%s."', true), $html->tag('strong',__('mi mejor plaza de juegos', true))); ?></p>
		<p><?php echo sprintf(__('Esta es la última y más importante etapa del proyecto. Es aquí donde todos tenemos la oportunidad de hacer realidad el sueño de los niños. Poder construir a escala real en 1.000m&sup2; el proyecto ganada de "%s"', true), $html->tag('strong',__('mi mejor plaza de juegos', true))); ?></p>
		<div id="votar_button"><?php echo $html->link(__('Quiero elegir la mejor plaza de juegos', true), array('controller' => 'plazas'))?></div>
	</div>
	<div id="votacion_container_right">
		<?php   
			if (!empty($plazas)) {
				foreach ($plazas as $plaza) {
		?>
		<div class="marco"> 
			<div class="clipwrapper">
				<div class="clip">                                                                  
					<?php if (!empty($plaza['PlazaImage'])): ?>  
						<div class="plaza_img"> 
							<div class="plaza_img_inner">
						<?php echo $html->image('plazas'. DS . 'preview'. DS .$plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))); ?>  
							</div>
						</div>
					<?php endif; ?>
					<div class="vote_box" style="display:none">
						<div class="vote_dialog">
							<?php echo $html->tag('p', sprintf(__('Ingresa tu mail para votar por esta plaza o puedes %s', true), $html->link(__('ver todas las plazas', true), array('controller' => 'plazas', 'action' => 'index')))); ?>
					  	</div>
						<div class="vote_form">    
							<?php $id = uniqid();?>      
							<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$id)); ?> 
							<?php echo $form->hidden('plaza_id', array('value' => $plaza['Plaza']['id'] )); ?>
							<?php echo $form->input('email', array('label' => array('text' => __('Tu mail', true), 'class' => 'label-over'), 'class' => 'validate-email', 'id' => uniqid('email_')))?>                                   
						   	<?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), '#', array('onclick' => "return vote('".$id."');",'class'=> 'btn_votar','style'=>'float:left', 'escape' => false))?>
							<?php echo $form->end();?> 
							<?php if (!empty($plaza['PlazaImage'])): ?>  
								 <div class="plaza_thumb"> 
								<?php echo $html->image('plazas' . DS . 'thumbs' . DS . $plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))); ?>  
								 </div>
							<?php endif; ?>   
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
