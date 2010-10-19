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
<?php echo $this->element('donation'); ?>
<div id="votacion_container">
	<h2 class="title"><?php echo __('Estas son nueve de las plazas más votadas', true); ?></h2>
    <?php echo $html->div('view_all', $html->link(__('ver todos', true), array('controller' => 'plazas', 'action' => 'index')), array('style' => 'float:right;margin-top:-30px;')); ?>
	<div id="votacion_container_left" class="font">
		<p><?php echo sprintf(__('Cientos de colegios participaron entre junio y agosto de 2010 en el Concurso LEGO CharityBox: %s. El certamen convocó a niños entre 6 y 10 años a construir con LEGO la plaza de sus sueños.', true), $html->tag('strong',__('Mi mejor plaza de juegos', true))); ?></p>    
		<p><?php echo sprintf(__('Hemos llegado a la última y más importante etapa. Por una parte la elección de la mejor plaza y por otra la posibilidad de que ésta se construya en la realidad. Hoy, TODOS pueden participar: ¡entre TODOS podemos hacer realidad este sueño! Queremos construir a escala real en Concepción el proyecto ganador en 1.000 m² , una de las zonas más afectadas por el terremoto."', true), $html->tag('strong',__('Mi mejor plaza de juegos', true))); ?></p>
		<div class="votar_button"><?php echo $html->link(__('Quiero elegir la mejor plaza de juegos', true), array('controller' => 'plazas'))?></div>
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
