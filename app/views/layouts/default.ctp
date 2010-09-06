<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> ::
		<?php echo $appConfigurations['name']; ?>
	</title>
	<?php
		if(!empty($meta_description)):
			echo $html->meta('description', $meta_description);
		endif;
		if(!empty($meta_keywords)) :
			echo $html->meta('keywords', $meta_keywords);
		endif;
		echo $html->css('reset');
        echo $html->css('main');
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
		echo $scripts_for_layout;
	?>
</head>
<body>
    <div id="wrap">
        <div class="container">
            <div id="header">
                <?php echo $this->element('header'); ?>
           </div>
            <div id="content">
                <?php echo $content_for_layout; ?>
            </div>
        </div>
        <?php echo $this->element('footer'); ?>
    </div>
    <div id="bg"><div><table cellpadding="0" cellspacing="0"><tr><td><?php echo $html->image('bg.png'); ?></td></tr></table></div></div>
</body>
</html>
