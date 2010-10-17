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
	
	<div id="left-col">
		<div class="bubble corner">
			<div class="rectangle"><h2><?php echo $school['School']['name']; ?><span><?php echo $school['School']['location']; ?></span></h2></div> 
			<div class="triangle-l"></div> <!-- Left triangle -->
			<div class="triangle-r"></div> <!-- Right triangle -->
				<div style="padding:10px; float:left;display:block;height:200px;width:250px"> 
				    <div class="plaza" id="plaza_<?php echo $school['Plaza'][0]['id']; ?>">
						<div class="plaza_content"> 
							<?php if (!empty($school['Plaza'][0]['PlazaImage'])): ?>  
					   			<div class="plaza_image corner"> 
									<div class="plaza_image_inner corner">
										<?php echo $html->link($html->image('plazas'. DS . 'vote'. DS .$school['Plaza'][0]['PlazaImage'][0]['image'], array('alt' => $school['School']['name'], 'rel' => Inflector::camelize( $school['School']['name'].$school['Plaza'][0]['id']))), '#', array('class' => 'group_'.$school['Plaza'][0]['id'], 'escape' => false)); ?>                     
								 	</div>
								</div>       
							<?php endif; ?> 
							<div class="vote_box corner" style="display:none"> 
								<div class="vote_box_inner corner">
									<?php echo $html->link($html->tag('span', __('Close', true)), "#", array('class' => 'close', 'onclick' => 'return showLogin({id:'.$school['Plaza'][0]['id'].'}, true);', 'escape' => false))?>
									<div class="clear"></div>
									<div class="vote_dialog">
				                        <?php echo $html->tag('p', $html->tag('strong', __('Para votar, tienes que registrarte.', true))); ?>            
								  	</div> 
									<div class="vote_form">    
										<?php echo $form->create('Votes', array('action' => 'vote', 'id' => "form_".$school['Plaza'][0]['id'])); ?> 
										<?php echo $form->hidden('Vote.plaza_id', array('value' => $school['Plaza'][0]['id'] )); ?> 
										<?php echo $form->input('User.username', array('label' => array('text' => __('Usuario', true), 'class' => 'label-over'), 'id' => uniqid('username_'))) ?>
										<?php echo $form->input('User.password', array('label' => array('text' => __('Contraseña', true), 'class' => 'label-over'), 'class' => 'short ', 'id' => uniqid('password_'), 'after' => $html->tag('span', $html->link(__('¿La olvidaste?', true), array('controller' => 'users', 'action' => 'recover')), array('class' => 'hint')))) ?>  
										<div style="margin:10px 0;">
										<?php echo $html->link($html->image('entrar.png', array('alt' => __('Ingresar', true))), '#', array('onclick' => 'return votePlaza({id:'.$school['Plaza'][0]['id'].'});', 'escape' => false)); ?>  
										<?php echo $html->tag('p', sprintf(__('¿No tienes una cuenta? %s ahora.', true), $html->link(__('Regístrate', true), array('controller' => 'users', 'action' => 'register'))), array('class' => 'hint')); ?>
										</div>  
										<?php echo $form->end();?>   
									</div>                           
									<?php if (!empty($school['Plaza'][0]['PlazaImage'])): ?>  
										<div class="plaza_thumb"> 
										<?php echo $html->image('plazas' . DS . 'thumbs' . DS . $school['Plaza'][0]['PlazaImage'][0]['image'], array('alt' => $school['School']['name'], 'rel' => Inflector::camelize( $school['School']['name'].$school['Plaza'][0]['id']))); ?>  
										</div>
										<div class="plaza_group">  
										<?php foreach ($school['Plaza'][0]['PlazaImage'] as $image): ?> 
											<?php echo $html->tag('p', $html->link($school['School']['name'], '/img/plazas' . DS . $image['image'], array('rel' => 'plaza_group_'.$school['Plaza'][0]['id'], 'title' => $school['School']['name'])))?>
										<?php endforeach; ?> 
										</div>  
									<?php endif; ?>   
								</div>
							</div>
							<div class="plaza_footer">
								<?php echo $html->link($html->image('ico_escritorio.png', array('alt' => $school['School']['name'])), array('controller' => 'plazas', 'action' => 'description', $school['Plaza'][0]['id']), array('class' => 'modal', 'escape' => false))?>
			                	<?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Votar', true))), array('controller' => 'plazas','action' => 'vote', '?' => array('url' => $school['Plaza'][0]['id'], 'callback' => 'votePlaza')), array('class' => 'VoteThisButton VoteWide', 'escape' => false)); ?>
							</div>
						</div> 
					</div>
			   	</div>
			    <p style="padding: 10px 10px;"><?php echo $school['Plaza'][0]['description']; ?></p>
				<div class="clear"></div> 
				<hr />
				<p style="padding: 5px 10px;"> 
				<?php echo $html->link(__('Twittear', true), 'http://twitter.com/share', array('class' => 'twitter-share-button', 'data-count' => 'horizontal', 'data-lang' => 'es')); ?>&nbsp;<iframe src="http://www.facebook.com/plugins/like.php?layout=button_count&amp;show_faces=false&amp;width=150&amp;action=recommend&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe></p>
		</div> 
	</div> 
	<div id="right-col">
		<?php echo $this->element('facebook_box'); ?>    
		<?php echo $this->element('waw_300_250');?>       
	</div>
	<div class="clear"></div>
	
			
                             
</div>