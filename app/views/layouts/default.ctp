<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> ::
		<?php echo $appConfigurations['name']; ?>
	</title>
	<?php
		if(!empty($meta_description)) :
			echo $html->meta('description', $meta_description);
		endif;
		if(!empty($meta_keywords)) :
			echo $html->meta('keywords', $meta_keywords);
		endif;
		echo $html->css('reset');
        echo $html->css('main');
        echo $html->css('/js/jquery/jquery.jcarousel/jquery.jcarousel.skin');
        echo $html->css('colorbox');
    ?>
    <!--[if IE]>
        <?php echo $javascript->link('http://html5shiv.googlecode.com/svn/trunk/html5.js'); ?>
    <![endif]-->
    <!--[if lte IE 7]>
        <?php echo $javascript->link('IE8'); ?>
    <![endif]-->
    <!--[if lt IE 7]>
        <?php echo $html->css('ie6.css'); ?>
    <![endif]-->
    
    <?php
		echo $javascript->link('jquery/jquery.min.js');
        echo $javascript->link('jquery/jquery-ui.min.js');
        echo $javascript->link('jquery/jquery.hoverIntent.min');
		echo $javascript->link('jquery/jquery.jcarousel/jquery.jcarousel.min');
        echo $javascript->link('jquery/jquery.corner');
        echo $javascript->link('jquery/jquery.colorbox');  
		echo $javascript->link('http://platform.twitter.com/widgets.js');
        echo $javascript->link('buttons');
		echo $javascript->link('main');
		echo $scripts_for_layout;
	?>
   

</head>
<body>
    <?php echo $this->element('message_hint'); ?>
   <div class="full header2">
        <div class="wrap">  
			<?php echo $html->image('logo_charitybox.png', array('alt' => __('Charity Box', true), 'id' => 'logo1')); ?>  
			<?php echo $this->element('menu_top'); ?>
            <?php echo $html->image('fundacionmustaki.png', array('alt' => __('Mustaki Foundation', true), 'id' => 'logo2')); ?>
            <div class="header2_1">
                <?php echo __('Con la ideas de los niños, construiremos la mejor plaza de juegos.  Necesitamos tu donación, para hacer realidad sus sueños.', true); ?>
            </div>
            <div class="header2_2">
                <ul>
                    <li><?php echo $html->image('paso1.png', array('alt' => __('Paso 1', true))); ?></li>
                    <li><?php echo $html->image('paso2.png', array('alt' => __('Paso 2', true))); ?></li>
                    <li><?php echo $html->image('paso3.png', array('alt' => __('Paso 3', true))); ?></li>
                </ul>
 				<div style="clear:both"></div>
            </div>
 		   
			<div class="social_connect">
		 		<?php echo sprintf(__('Que todos se enteren de esta gran causa: %s', true),  $html->link(__('Twittear', true), 'http://twitter.com/share', array('class' => 'twitter-share-button', 'data-count' => 'horizontal', 'data-lang' => 'es'))); ?><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.regalaunaplaza.cl/plazas&amp;layout=button_count&amp;show_faces=true&amp;width=150&amp;action=recommend&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
			    <?php echo $this->element('social_connect');?>
			</div>                                            
			
        </div> 
    </div>
    <div id="main_content" class="wrap">  
	<?php echo $this->element('top_search'); ?> 
	 <?php echo $this->Session->flash('email'); ?> 
		<div id="content">  
			<?php
	                if($session->check('Message.flash')){     
						$session->flash();
	                }

	                if($session->check('Message.auth')){
						$session->flash('auth');
	                }
	        ?>
	        
        <?php echo $content_for_layout; ?>
        </div>
    </div>
	<?php echo $this->element('footer'); ?>   
    <?php echo $this->element('litebox'); ?> 
	<?php echo $this->element('analytics')?>  
	<?php echo $this->element('sql_dump');?>
</body>                                      
</html>
