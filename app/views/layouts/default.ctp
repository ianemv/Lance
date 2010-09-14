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
		echo $scripts_for_layout;
	?>
   

</head>
<body>
    <div class="full header1">
        <div class="wrap">
            <?php echo $html->image('logo_charitybox.png', array('alt' => __('Charity Box', true), 'id' => 'logo1')); ?>
            <?php echo $html->image('fundacionmustaki.png', array('alt' => __('Mustaki Foundation', true), 'id' => 'logo2')); ?>
        </div>
    </div>
    <div class="full header2">
        <div class="wrap">
            <div class="header2_1">
                <?php echo __('The children dream it, and we\'ll build it.  We need your donation, to make the dream a reality.', true); ?>
            </div>
            <div class="header2_2">
                <ul>
                    <li><?php echo $html->image('paso1.png', array('alt' => __('Step 1', true))); ?></li>
                    <li><?php echo $html->image('paso2.png', array('alt' => __('Step 2', true))); ?></li>
                    <li><?php echo $html->image('paso3.png', array('alt' => __('Step 3', true))); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="main_content" class="wrap">
        <?php echo $this->element('donation'); ?>
        <?php echo $content_for_layout; ?>
    </div>
	<?php echo $this->element('footer'); ?>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
