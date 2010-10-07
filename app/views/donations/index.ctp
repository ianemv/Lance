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
<?php $plazas = $this->requestAction('/plazas/getplazas/limit:6');  ?> 
<?php echo $this->element('donation'); ?>
<div id="votacion_container">
	<h2 class="title"><?php echo __('Estas son seis de las plazas más votadas', true); ?></h2>
    <?php echo $html->div('view_all', $html->link(__('ver todos', true), array('controller' => 'plazas', 'action' => 'index')), array('style' => 'float:right;margin-top:-30px;')); ?>
	<div id="votacion_container_left" class="font">
		<p><?php echo sprintf(__('Entre junio y agosto del año 2010, fueron cientos los colegios que participaron en el concurso de construcción con piezas de Lego para realizar "%s."', true), $html->tag('strong',__('Mi mejor plaza de juegos', true))); ?></p>    
		<p><?php echo sprintf(__('Esta es la última y más importante etapa del proyecto. Es aquí donde todos tenemos la oportunidad de hacer realidad el sueño de los niños. Poder construir a escala real en  1.000m&sup2; en Concepción, una de las zonas afectadas por el terremoto, el proyecto ganador de "%s"', true), $html->tag('strong',__('Mi mejor plaza de juegos', true))); ?></p>
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
					   			<?php echo $html->link($html->image('plazas'. DS . 'preview'. DS .$plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))), '#', array('class' => 'group_'.$plaza['Plaza']['id'], 'escape' => false)); ?>  
							</div>   
							<div class="plaza_group">  
							<?php foreach ($plaza['PlazaImage'] as $image): ?> 
								<?php echo $html->tag('p', $html->link($plaza['School']['name'], '/img/plazas' . DS . $image['image'], array('rel' => 'plaza_group_'.$plaza['Plaza']['id'], 'title' => $plaza['School']['name'])))?>
							<?php endforeach; ?> 
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
