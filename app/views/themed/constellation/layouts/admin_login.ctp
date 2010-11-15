<!DOCTYPE html>
<html lang="en">
<head>

	<title><?php echo $title_for_layout; ?> :: <?php echo $appConfigurations['name']; ?></title>
	<?php echo $html->charset(); ?>
	
	<!-- Global stylesheets -->   
	<?php
		echo $html->css('admin/reset');
		echo $html->css('admin/common');
		echo $html->css('admin/form');
		echo $html->css('admin/standard');
		echo $html->css('admin/special-pages');
	?>

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="icon" type="image/png" href="favicon-large.png">
	
	<!-- Generic libs --> 
	<?php  
		echo $javascript->link('admin/html5');
		echo $javascript->link('jquery/jquery-1.4.2.min.js');
		echo $javascript->link('admin/old-browsers');
	?>
	
	<!-- Template core functions -->  
	<?php  
		echo $javascript->link('admin/common');
		echo $javascript->link('admin/standard'); 
    ?>
	<!--[if lte IE 8]><?php echo $javascript->link('standard.ie'); ?><![endif]--> 
	<?php
		echo $javascript->link('jquery/jquery.tip');
	?>
	
	<!-- example login script -->
	<?php
		echo $scripts_for_layout;	
	?>
	
</head>
	<!-- the 'special-page' class is only an identifier for scripts -->
<body class="special-page login-bg dark">
	<!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie, .ie7 or .ie6 prefix to your css selectors when needed -->
	<!--[if lt IE 9]><div class="ie"><![endif]-->
	<!--[if lt IE 8]><div class="ie7"><![endif]-->
       
		<section id="login-block">
			<div class="block-border">
				<div class="block-content">
					<?php echo $content_for_layout ; ?>   
				</div>
			</div>
		</section>
	<!--[if lt IE 8]></div><![endif]-->
	<!--[if lt IE 9]></div><![endif]-->
</body>
</html>