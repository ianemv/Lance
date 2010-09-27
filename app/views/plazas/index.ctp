<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() { 
		$(".plaza_img").corner(); 
        $(".vote_box").corner();   

    }); 
    function votePlaza(a) {
        $.post("<?php echo $html->url(array('controller' => 'votes', 'action' => 'plaza')); ?>", $("#form_"+a.id).serialize(), function(result) {
            if (!result.success) {
                if (result.login) {
                    showLogin(a);
                }
                messageHint(result.message);
            } else {
                if (result.message) {
                    messageHint(result.message);
                }
            }
        }, "json");
        return false;
    }
    function showLogin(a) {
        var marco = $("#plaza_"+a.id);
        var plazaImg = $(marco).find('.plaza_img');
        var thumbRel = $(marco).find('.plaza_img img').attr('rel');
        $(plazaImg).fadeOut();
        $(marco).find(".vote_box").effect('slide', {direction:'up'}, 200).effect('transfer', {to: $(".plaza_thumb img[rel='"+thumbRel+"']")}, 500);
        $(marco).find('.vote_dialog').effect('bounce', {direction:'down'},200);
        $(marco).find('.vote_bottom').hide();
        $(".plaza_thum img[rel='"+thumbRel+"']").animate({opacity: 1.0}, 1000);
    }
<?php echo $javascript->blockEnd(); ?>
<a href="/login" class="modal">Plazas</a>
<h2><?php echo __('Vota por tu plaza favorita', true); ?></h2>
<p><?php echo sprintf(__('Entre junio y agosto del año 2010, fueron cientos los colegios que participaron en el concurso de construcción con piezas de Lego para realizar "%s."', true), $html->tag('strong',__('mi mejor plaza de juegos', true))); ?></p>
<p><?php echo sprintf(__('Esta es la última y más importante etapa del proyecto. Es aquí donde todos tenemos la oportunidad de hacer realidad el sueño de los niños. Poder construir a escala real en 1.000m&sup2; el proyecto ganada de "%s"', true), $html->tag('strong',__('mi mejor plaza de juegos', true))); ?></p>    

<div id="votacion_container_full"> 
    	<div class="pagination">
	        	<?php echo $this->Paginator->first('<<'.__('First', true), array()); ?>
	        	<?php echo $this->Paginator->prev('<<'.__('Previous', true), array(), null, array('class' => 'disabled')); ?>
	        	<?php echo $this->Paginator->numbers(array('class' => 'number', 'separator' => '')); ?>
	        	<?php echo $this->Paginator->next(__('Next', true).'>>', array(), null, array('class' => 'disabled')); ?>
	        	<?php echo $this->Paginator->last(__('Last', true).'>>', array()); ?>
	    </div>
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
                        <?php echo $html->tag('p', $html->tag('strong', __('Tienes que ingresar para votar', true))); ?>
						<?php echo $html->tag('p', sprintf(__('Para votar por esta plaza, ingresa al ', true), $html->link(__('ver todas las plazas', true), array('controller' => 'plazas', 'action' => 'index')))); ?>
				  	</div>
					<div class="vote_form">    
						<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$plaza['Plaza']['id'])); ?> 
						<?php echo $form->hidden('plaza_id', array('value' => $plaza['Plaza']['id'] )); ?>
						<?php echo $form->input('email', array('label' => array('text' => __('Tu mail', true), 'class' => 'label-over'), 'class' => 'validate-email', 'id' => uniqid('email_')))?>                                   
                        <?php echo $form->input('password', array('label' => array('text' => __('Contraseña', true), 'class' => 'label-over'), 'id' => uniqid('password_'))); ?>
						<?php echo $form->end();?> 
					</div> 
                    <?php if (!empty($plaza['PlazaImage'])): ?>  
						<div class="plaza_thumb"> 
						<?php echo $html->image('plazas' . DS . 'thumbs' . DS . $plaza['PlazaImage'][0]['image'], array('alt' => $plaza['School']['name'], 'rel' => Inflector::camelize( $plaza['School']['name'].$plaza['Plaza']['id']))); ?>  
						</div>
					<?php endif; ?>   
			  	</div>  
			  	<div class="vote_bottom">
                <div class="vote_info">
                sdf
                </div>
                
                <?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), array('controller' => 'plazas','action' => 'vote', '?' => array('url' => $plaza['Plaza']['id'], 'callback' => 'votePlaza')), array('class' => 'VoteThisButton VoteWide', 'escape' => false)); ?>
				<?php #echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), '#', array('onclick' => "return vote('".$id."');",'class'=> 'btn_votar','style'=>'float:left', 'escape' => false))?>  
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

