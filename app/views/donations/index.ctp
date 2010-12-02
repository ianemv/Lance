<?php echo $javascript->codeBlock(null, array('inline' => false)); ?>
    $(document).ready(function() { 
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
<?php $plazas = $this->requestAction('/plazas/getplazas/limit:9');  ?>
<?php if (!Configure::read('dev')): ?> 
<?php echo $this->element('donation'); ?>  
<?php else: ?>
<?php echo $this->element('plaza_grid'); ?>  
<?php endif; ?>
<div id="votacion_container">
	<h2 class="title"><?php echo __('Resultados Votación', true); ?></h2>
    <?php echo $html->div('view_all', $html->link(__('ver todos', true), array('controller' => 'plazas', 'action' => 'index')), array('style' => 'float:right;margin-top:-30px;')); ?>
	<div id="votacion_container_left" class="font">
		<p><?php echo __('Queremos felicitar a todos los colegios que han participado activamente en el proyecto Regala Una Plaza. Los resultados fueron increíbles. Miles de niños tuvieron la oportunidad de imaginar, crear y construir con LEGOS, el sueño de su mejor plaza de juegos.', true); ?></p>    
		<p><?php echo __('Nuestro ganador del concurso es el "Complejo Educacional Apumanque de La Calera". Muchas felicidades a sus pequeños grandes arquitectos ¡Su plaza será construida a escala real en Concepción, una vez que se reúnan los fondos necesarios!', true); ?></p>
		<p><?php echo __('Les comunicamos que hemos hecho una adaptación en la estructura de los premios. Además de premiar a los 9 ganadores por votación del público, tendremos ahora 9 premios para los establecimientos educacionales que sean escogidos por nuestro comité de jueces. Estos ganadores serán dados a conocer el 25 de Noviembre 2010. Pueden ver la nueva estructura de los premios en el link que está más abajo.', true); ?></p> 
		<p><?php echo __('Todos los premios serán enviados a los respectivos colegios después de la ceremonia de premiación, que se realizará el día 06 de Diciembre en Santiago.', true); ?></p>
		<p><?php echo sprintf(__('Para ver los premios y el listado de los colegios ganadores por votación del público sólo deben pulsar %s.', true), $html->link(__('aquí', true), '/files/CB_Ganadores_Votacion.pdf')); ?></p>
		<p><?php echo sprintf(__('Para ver el ranking de votos para todos los instituciones sólo deben pulsar %s.', true), $html->link(__('aquí', true), '/files/CB_Ranking_Ganadores_Votacion.pdf')); ?></p> 
	</div>
	<div id="votacion_container_right">
		<?php   
			if (!empty($plazas)) {
				foreach ($plazas as $plaza) {
		?>
		<div class="bubble bubble-small corner" id="plaza_<?php echo $plaza['Plaza']['id']; ?>"> 
			<div class="rectangle"><h2><?php echo $html->link($text->truncate($plaza['School']['name'], 30), array('controller' => 'schools', 'action' => 'view', $plaza['School']['id'])); ?><span><?php echo sprintf(__('Votos: %d', true), $plaza['Plaza']['vote_count']); ?></span></h2></div> 
			<div class="triangle-l"></div> <!-- Left triangle -->
			<div class="triangle-r"></div> <!-- Right triangle -->                                         
			<?php if (!empty($plaza['PlazaImage'])): ?>  
				<div class="plaza_image corner"> 
					<div class="plaza_image_inner">  
			   			<?php echo $html->link($html->image('plazas'. DS . 'preview'. DS .$plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))), '#', array('class' => 'group_'.$plaza['Plaza']['id'], 'escape' => false)); ?>  
					</div>   
					<div class="plaza_group">  
					<?php foreach ($plaza['PlazaImage'] as $image): ?> 
						<?php echo $html->tag('p', $html->link($plaza['School']['name'], '/img/plazas' . DS . $image['image'], array('rel' => 'plaza_group_'.$plaza['Plaza']['id'], 'title' => $plaza['School']['name'])))?>
					<?php endforeach; ?> 
					</div>
				</div>
			<?php endif; ?>
		</div> 	  
		<?php		
				}                     
			} else {
				echo __('Encontró Ningún Plaza.', true);
			}
		?>
	</div>  
</div>      
<div class="clear"></div>
