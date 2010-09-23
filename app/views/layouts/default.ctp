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
        echo $html->css('/js/facebox/facebox.css');
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
		echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
        echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
        echo $javascript->link('jquery/jquery.hoverIntent.min');
		echo $javascript->link('jquery/jquery.jcarousel/jquery.jcarousel.min');
        echo $javascript->link('jquery/jquery.corner');
        echo $javascript->link('facebox/facebox');  
		echo $javascript->link('http://platform.twitter.com/widgets.js');
		echo $javascript->link('main');
		echo $scripts_for_layout;
	?>
   

</head>
<body>
    <div class="full header2">
        <div class="wrap">  
			<?php echo $html->image('logo_charitybox.png', array('alt' => __('Charity Box', true), 'id' => 'logo1')); ?>  
			<?php echo $this->element('menu_top'); ?>
            <?php echo $html->image('fundacionmustaki.png', array('alt' => __('Mustaki Foundation', true), 'id' => 'logo2')); ?>
            <div class="header2_1">
                <?php echo __('Con la ideas de los niños, construiremos la mejor plaza de juegos.  Necesitamos tu donación, para hacer real su sueño.', true); ?>
            </div>
            <div class="header2_2">
                <ul>
                    <li><?php echo $html->image('paso1.png', array('alt' => __('Paso 1', true))); ?></li>
                    <li><?php echo $html->image('paso2.png', array('alt' => __('Paso 2', true))); ?></li>
                    <li><?php echo $html->image('paso3.png', array('alt' => __('Paso 3', true))); ?></li>
                </ul>
            </div>
 			<div style="clear:both"></div>
			<div class="social_connect"> 
		 		<?php echo sprintf(__('Que todos se enteren de esta gran causa: %s', true),  $html->link(__('Twittear', true), 'http://twitter.com/share', array('class' => 'twitter-share-button', 'data-count' => 'horizontal', 'data-lang' => 'es'))); ?><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.regalaunaplaza.cl&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=recommend&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:21px;" allowTransparency="true"></iframe> 
			   <div style="float:right; margin-right:50px;">  
					 <ul class="social_icons">
		                <li><?php echo $html->link($html->image('icono_twitter.png', array('alt' => __('Twitter', true))), 'http://twitter.com/Regalaunaplaza', array('escape' => false)); ?></li>
						<li><?php echo $html->link($html->image('icono_facebook.png', array('alt' => __('Facebook', true))), 'http://www.facebook.com/legocharitybox', array('escape' => false)); ?></li>
						<li><?php echo $html->link($html->image('icono_youtube.png', array('alt' => __('YouTube', true))), 'http://www.youtube.com/user/Regalaunaplaza', array('escape' => false)); ?></li>
						<li><?php echo $html->link($html->image('icono_flickr.png', array('alt' => __('Flickr', true))), 'http://www.flickr.com/photos/fllchile/sets/72157624650846249/', array('escape' => false)); ?></li>
	                  
	                </ul>           
				</div>
			</div>  
        </div> 
    </div>
    <div id="main_content" class="wrap">   
		<div id="content"> 
        <?php echo $content_for_layout; ?>
        </div>
    </div>
	<?php echo $this->element('footer'); ?>   
    <?php echo $html->div('equipo', $html->link($html->tag('span', __('Equipo', true)), '/equipo', array('escape' => false))); ?> &nbsp; | &nbsp;
	<?php echo $html->div('contact', $html->link($html->tag('span', __('Contacto', true)), '/contacto', array('escape' => false))); ?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
