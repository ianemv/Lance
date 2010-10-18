<?php
	$html->meta(null, null, array('property' => 'og:title', 'content' => $appConfigurations['name']."::".$school['School']['name']."-". $school['School']['name'], 'inline' => false));
	$html->meta(null, null, array('property' => 'og:description', 'content' => Sanitize::html($school['Plaza'][0]['description']) , 'inline' => false));
	$html->meta(null, null, array('property' => 'og:image', 'content' => $html->url($appConfigurations['url'] . IMAGES_URL . 'plazas'. DS . 'vote'. DS .$school['Plaza'][0]['PlazaImage'][0]['image']), 'inline' => false)); 
?>
<?php echo $javascript->link('http://static.ak.fbcdn.net/connect.php/js/FB.Share', array('inline' => false)); ?>
<?php echo $javascript->codeBlock(); ?>
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
 })
<?php echo $javascript->blockEnd(); ?>   
<div class="view school">
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
			    <p style="padding: 10px 10px;"><?php echo Sanitize::html($school['Plaza'][0]['description']); ?></p>
				<div class="clear"></div> 
				<hr />
				<p>  
					<ul class="actions">
						<li class="sharing-option"><?php echo $html->link(__('Twittear', true), "http://twitter.com/share?text=".$appConfigurations['name']."::".$school['School']['name']." - ".$school['School']['location']."&url=".$html->url(null, true)."&amp;via=".$appConfigurations['name'], array('class' => 'sharing-twitter twitter-share-button', 'data-count' => 'none', 'data-lang' => 'es')); ?></li>
						<li class="sharing-option"><?php echo $html->link(__('Facebook', true), 'http://www.facebook.com/sharer.php?u='.$html->url(null, true).'&t='.$school['School']['name']." - ".$school['School']['location'], array('name' => 'fb_share', 'type' => 'button_count', 'class' => 'sharing-facebook facebook-share-button')); ?></li>
					 	<li><?php echo $html->link($html->image('share-email.png', array('alt' => '')), "mailto:?subject=".$appConfigurations['name'].": ".$school['School']['name']."-".$school['School']['location']."&body=".sprintf(__('Mira esta plaza de juegos en el proyecto "%s".', true), $appConfigurations['name'])."\n\n ".__('Te invito que votes por ella. Los 9 proyectos más votados serán premiados con premios de LEGO Educación.', true) . "\n\n" . sprintf(__('Haz clic en este link y vota: %s', true), $html->url(null, true)), array('class' => 'sharing-email', 'escape' => false)); ?></li>
					</ul> 
					<div class="clear"></div>

				</p>
		</div> 
	</div> 
	<div id="right-col" style="postion:relative;">
		 
		<?php echo $this->element('waw_300_250');?> 
		<?php echo $this->element('facebook_box'); ?>      
	</div>
	<div class="clear"></div>
	
			
                             
</div>