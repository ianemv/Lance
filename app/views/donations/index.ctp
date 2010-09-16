<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() {
        $('#votacion_container_right .marco').hoverIntent(
           function() {
               $(this).find(".vote_box").effect('slide', {direction:'up'}, 200);
               $(this).find('.vote_dialog').effect('bounce', {direction:'down'},200);
               $(this).find(".plaza_img").fadeOut();
           },
           function() {
               $(this).find(".vote_box").fadeOut();
               $(this).find(".plaza_img").fadeIn();
               $(this).find(".vote_form input").val();
           }
       ); 
        $(".vote_form label").click(function() {
            $(this).hide();
            $(this).parent().find(".vote_form input").val('here');
        });
        $(".vote_box").corner();
    });
<?php echo $javascript->blockEnd(); ?>
<?php $plazas = $this->requestAction('/plazas/getplazas/limit:1');  ?>

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
						<?php echo $html->image($plaza['PlazaImage'][0], array('alt' => '', 'class' => 'plaza_img')); ?>
					<?php endif; ?>   
                    <?php echo $html->image('schools/8490bd465c67da92604d602ea824e3f6eb6631ed.jpg', array('style' => "width:170px; height: 150px;", 'class' => 'plaza_img')); ?>
					<div class="vote_box" style="display:none">
						<div class="vote_dialog">
							<?php echo $html->tag('p', sprintf(__('Ingresa tu mail para votar por esta plaza o puedes %s', true), $html->link(__('ver todas las plazas', true), array('controller' => 'plazas', 'action' => 'index')))); ?>
					  	</div>
						<div class="vote_form"> 
							   <?php echo $form->input('email', array('label' => __('Tu mail', true)))?>
							   <?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), '#', array('class'=> 'btn_votar', 'escape' => false))?>
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
