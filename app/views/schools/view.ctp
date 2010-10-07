<?php echo $javascript->codeBlock(); ?>
 $(document).ready(function() { 
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
 })
<?php echo $javascript->blockEnd(); ?>   
<div class="view school">
	<h2 class="title"><?php echo $school['School']['name']; ?><span><?php echo $school['School']['location']; ?></span></h2>    
	<div class="bubble corner">
		<div class="rectangle"><h2><?php echo $school['School']['name']; ?><span><?php echo $school['School']['location']; ?></span></h2></div> 
		<div class="triangle-l"></div> <!-- Left triangle -->
		<div class="triangle-r"></div> <!-- Right triangle -->
		<div class="info"> 
			
			<div class="marco" id="plaza_<?php echo $school['Plaza'][0]['id']; ?>"> 
				<div class="clipwrapper">
					<div class="clip">
			       	<?php if (!empty($school['Plaza'][0]['PlazaImage'])): ?>  
						<div class="plaza_img"> 
							<div class="plaza_img_inner corner">  
					   			<?php echo $html->link($html->image('plazas'. DS . 'vote'. DS .$school['Plaza'][0]['PlazaImage'][0]['image'], array('alt' => $school['School']['name'], 'rel' => Inflector::camelize( $school['School']['name'].$school['Plaza'][0]['id']))), '#', array('class' => 'group_'.$school['Plaza'][0]['id'], 'escape' => false)); ?>  
							</div>
						</div>
					<?php endif; ?>	 
						<div class="vote_box" style="display:none">
							<div class="vote_dialog">
			                    <?php echo $html->tag('p', $html->tag('strong', __('Para votar, ingresa tus datos.', true))); ?>            
								<?php echo $html->tag('p', sprintf(__('Recuerda, tienes solamente tres votos cada día. ', true))); ?>
						  	</div>
							<div class="vote_form">    
								<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$school['Plaza'][0]['id'])); ?> 
								<?php echo $form->hidden('Vote.plaza_id', array('value' => $school['Plaza'][0]['id'] )); ?>
								<?php echo $form->input('User.first_name', array('label' => array('text' => __('Nombre', true), 'class' => 'label-over'), 'id' => uniqid('nombre_')))?>
								<?php echo $form->input('User.last_name', array('label' => array('text' => __('Apellido', true), 'class' => 'label-over'), 'id' => uniqid('apellido_')))?>                                   
			                    <?php echo $form->input('User.email', array('label' => array('text' => __('Mail', true), 'class' => 'label-over'), 'class' => 'validate-email', 'id' => uniqid('mail_'))); ?>                     
								<?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), '#', array('onclick' => 'return votePlaza({id:'.$school['Plaza'][0]['id'].'});', 'escape' => false)); ?>
								<?php echo $form->end();?> 
							</div> 
			                <?php if (!empty($school['Plaza'][0]['PlazaImage'])): ?>  
								<div class="plaza_thumb"> 
								<?php echo $html->image('plazas' . DS . 'thumbs' . DS . $school['Plaza'][0]['PlazaImage'][0]['image'], array('alt' => $school['School']['name'], 'rel' => Inflector::camelize( $school['School']['name'].$school['Plaza'][0]['id']))); ?>  
								</div>
							<?php endif; ?>   
					  	</div> 
					   	<div class="vote_bottom">
						<?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), array('controller' => 'plazas','action' => 'vote', '?' => array('url' => $school['Plaza'][0]['id'], 'callback' => 'votePlaza')), array('class' => 'VoteThisButton VoteWide', 'escape' => false)); ?> 
					   </div>
			  		</div>
					
				</div>

	   		</div> 
	
			<p><?php echo $school['Plaza'][0]['description']; ?></p> 
			 <div class="clear"></div>
			<hr />
	   	</div>
	</div>
			
                             
</div>