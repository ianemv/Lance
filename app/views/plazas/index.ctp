<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() { 
		$(".plaza_img").corner(); 
        $(".vote_box").corner();  
 		$(".ghog-pop").click(function() {
			var a = $(this).attr('rel');
			$(".plaza_"+a).colorbox({open:true, maxWidth:"800px", opacity:0.50, transition:"fade"}); 
			return false;  
		})
    }); 
<?php echo $javascript->blockEnd(); ?>
<h2><?php echo __('Vota por tu plaza favorita', true); ?></h2>
<p><?php echo sprintf(__('Entre junio y agosto del año 2010, fueron cientos los colegios que participaron en el concurso de construcción con piezas de Lego para realizar "%s."', true), $html->tag('strong',__('mi mejor plaza de juegos', true))); ?></p>
<p><?php echo sprintf(__('Esta es la última y más importante etapa del proyecto. Es aquí donde todos tenemos la oportunidad de hacer realidad el sueño de los niños. Poder construir a escala real en 1.000m&sup2; el proyecto ganada de "%s"', true), $html->tag('strong',__('mi mejor plaza de juegos', true))); ?></p>    

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
					<?php echo $html->image('plazas'. DS . 'vote'. DS .$plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))); ?>  
						</div>
					</div>
				<?php endif; ?>
				<div class="vote_box" style="display:none">
					<div class="vote_dialog">
                        <?php echo $html->tag('p', $html->tag('strong', __('Para votar, ingresa tus datos.', true))); ?>            
						<?php echo $html->tag('p', sprintf(__('Recuerda, tienes solamente tres votos cada día. ', true))); ?>
				  	</div>
					<div class="vote_form">    
						<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$plaza['Plaza']['id'])); ?> 
						<?php echo $form->hidden('Vote.plaza_id', array('value' => $plaza['Plaza']['id'] )); ?>
						<?php echo $form->input('User.first_name', array('label' => array('text' => __('Nombre', true), 'class' => 'label-over'), 'id' => uniqid('nombre_')))?>
						<?php echo $form->input('User.last_name', array('label' => array('text' => __('Apellido', true), 'class' => 'label-over'), 'id' => uniqid('apellido_')))?>                                   
                        <?php echo $form->input('User.email', array('label' => array('text' => __('Mail', true), 'class' => 'label-over'), 'class' => 'validate-email', 'id' => uniqid('mail_'))); ?>                     
						<?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), '#', array('onclick' => 'return votePlaza({id:'.$plaza['Plaza']['id'].'});', 'escape' => false)); ?>
						<?php echo $form->end();?> 
					</div> 
                    <?php if (!empty($plaza['PlazaImage'])): ?>  
						<div class="plaza_thumb"> 
						<?php echo $html->image('plazas' . DS . 'thumbs' . DS . $plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))); ?>  
						</div>
						<div class="plaza_group">  
						<?php foreach ($plaza['PlazaImage'] as $image): ?> 
							<?php echo $html->tag('p', $html->link($plaza['School']['name'], '/img/plazas' . DS . $image['image'], array('class' => 'plaza_group_'.$plaza['Plaza']['id'], 'title' => $plaza['School']['name'])))?>
						<?php endforeach; ?> 
						</div>  
					<?php endif; ?>   
			  	</div>  
			  	<div class="vote_bottom"> 
					<ul>
						<li class=""><?php echo $html->link(__('Plazas', true), '#', array('rel' => 'group_'.$plaza['Plaza']['id'], 'class' => 'ghog-pop')); ?></li>
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


