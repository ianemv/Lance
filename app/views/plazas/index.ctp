<h2><?php echo __('Vota por tu plaza favorita', true); ?></h2>
<p><?php echo sprintf(__('Entre junio y agosto del año 2010, fueron cientos los colegios que participaron en el concurso de construcción con piezas de Lego para realizar "%s."', true), $html->tag('strong',__('mi mejor plaza de juegos', true))); ?></p>
<p><?php echo sprintf(__('Esta es la última y más importante etapa del proyecto. Es aquí donde todos tenemos la oportunidad de hacer realidad el sueño de los niños. Poder construir a escala real en 1.000m&sup2; el proyecto ganada de "%s"', true), $html->tag('strong',__('mi mejor plaza de juegos', true))); ?></p>    

<div id="votacion_container_full"> 

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
<div style="clear:both;"></div>   
 <div class="pagination">
        	<?php echo $this->Paginator->first('<<'.__('First', true), array()); ?>
        	<?php echo $this->Paginator->prev('<<'.__('Previous', true), array(), null, array('class' => 'disabled')); ?>
        	<?php echo $this->Paginator->numbers(array('class' => 'number', 'separator' => '')); ?>
        	<?php echo $this->Paginator->next(__('Next', true).'>>', array(), null, array('class' => 'disabled')); ?>
        	<?php echo $this->Paginator->last(__('Last', true).'>>', array()); ?>
    </div>

