<!DOCTYPE html>
<html lang="en">
<head>

	<title><?php echo $title_for_layout; ?> :: <?php echo $appConfigurations['name']; ?></title>
	<meta charset="utf-8">

	<!-- Global stylesheets -->
	<?php
		echo $html->css('admin/reset');
		echo $html->css('admin/common');
		echo $html->css('admin/form');
	    echo $html->css('admin/standard');
	?>
	
	<!-- Comment/uncomment one of these files to toggle between fixed and fluid layout -->
	<?php                    
		#echo $html->css('admin/960.gs');
		echo $html->css('admin/960.gs.fluid');  
	?>
	
	<!-- Custom styles -->  
	<?php
		echo $html->css('admin/simple-lists');
		echo $html->css('admin/block-lists');
		echo $html->css('admin/planning');
		echo $html->css('admin/table');   
        
		echo $html->css('admin/calendars');
		echo $html->css('admin/wizard');
		echo $html->css('admin/gallery');
		echo $html->css('admin/wysiwyg');
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
	
	<!-- Template libs --> 
	<?php  
		echo $javascript->link('jquery/jquery.accessibleList');
		#echo $javascript->link('jquery/jquery.wysiwyg');
	    echo $javascript->link('admin/searchField');
	 	echo $javascript->link('admin/common');
	 	echo $javascript->link('admin/standard');
	?>                                           
	<!--[if lte IE 8]><?php echo $javascript->link('standard.ie'); ?><![endif]--> 
	<?php
		echo $javascript->link('jquery/jquery.tip');
		echo $javascript->link('jquery/jquery.hashchange');
		echo $javascript->link('jquery/jquery.contextMenu');
		
		
	?>
	
	<!-- Custom styles lib -->   
	<?php
		echo $javascript->link('admin/list');
	?>
	
	<!-- Charts library -->
	<!--Load the AJAX API-->  
	<?php
		echo $javascript->link('http://www.google.com/jsapi');
	?>
	<script type="text/javascript">
		// Load the Visualization API and the piechart package.
		google.load('visualization', '1', {'packages':['corechart']});
		
	</script>
	
	<!-- Example context menu -->
	<script type="text/javascript">
	
		$(document).ready(function()
		{ 
			// Context menu for all favorites
			$('.favorites li').bind('contextMenu', function(event, list)
			{
				var li = $(this);
				
				// Add links to the menu
				if (li.prev().length > 0)
				{
					list.push({ text: 'Move up', link:'#', icon:'up' });
				}
				if (li.next().length > 0)
				{
					list.push({ text: 'Move down', link:'#', icon:'down' });
				}
				list.push(false);	// Separator
				list.push({ text: 'Delete', link:'#', icon:'delete' });
				list.push({ text: 'Edit', link:'#', icon:'edit' });
			});
			
			// Extra options for the first one
			$('.favorites li:first').bind('contextMenu', function(event, list)
			{
				list.push(false);	// Separator
				list.push({ text: 'Settings', icon:'terminal', link:'#', subs:[
					{ text: 'General settings', link: '#', icon: 'blog' },
					{ text: 'System settings', link: '#', icon: 'server' },
					{ text: 'Website settings', link: '#', icon: 'network' }
				] });
			});
		});
	
	</script>
	
	<?php
		echo $scripts_for_layout;	
	?>
	
</head>

<body>
<!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie or .ie7 prefix to your css selectors when needed -->
<!--[if lt IE 9]><div class="ie"><![endif]-->
<!--[if lt IE 8]><div class="ie7"><![endif]-->
	
	<!-- Header -->
	
	<!-- Server status -->
	<?php echo $this->element('header/server_status'); ?>
	<!-- End server status -->

	<!-- Main nav -->
	<?php echo $this->element('header/main_nav'); ?>
	<!-- 
	<nav id="main-nav">
		
		<ul class="container_12">
			<li class="home current"><a href="#" title="Home">Home</a>
				<ul>
					<li class="current"><a href="#" title="Dashboard">Dashboard</a></li>
					<li><a href="#" title="My profile">My profile</a></li>
					<li class="with-menu"><a href="#" title="My settings">My settings</a>
						<div class="menu">
							<img src="images/menu-open-arrow.png" width="16" height="16">
							<ul>
								<li class="icon_address"><a href="#">Browse by</a>
									<ul>
										<li class="icon_blog"><a href="#">Blog</a>
											<ul>
												<li class="icon_alarm"><a href="#">Recents</a>
													<ul>
														<li class="icon_building"><a href="#">Corporate blog</a></li>
														<li class="icon_newspaper"><a href="#">Press blog</a></li>
													</ul>
												</li>
												<li class="icon_building"><a href="#">Corporate blog</a></li>
												<li class="icon_computer"><a href="#">Support blog</a></li>
												<li class="icon_search"><a href="#">Search...</a></li>
											</ul>
										</li>
										<li class="icon_server"><a href="#">Website</a></li>
										<li class="icon_network"><a href="#">Domain</a></li>
									</ul>
								</li>
								<li class="icon_export"><a href="#">Export</a>
									<ul>
										<li class="icon_doc_excel"><a href="#">Excel</a></li>
										<li class="icon_doc_csv"><a href="#">CSV</a></li>
										<li class="icon_doc_pdf"><a href="#">PDF</a></li>
										<li class="icon_doc_image"><a href="#">Image</a></li>
										<li class="icon_doc_web"><a href="#">Html</a></li>
									</ul>
								</li>
								<li class="sep"></li>
								<li class="icon_refresh"><a href="#">Reload</a></li>
								<li class="icon_reset">Reset</li>
								<li class="icon_search"><a href="#">Search</a></li>
								<li class="sep"></li>
								<li class="icon_terminal"><a href="#">Custom request</a></li>
								<li class="icon_battery"><a href="#">Stats server load</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li class="write"><a href="#" title="Write">Write</a>
				<ul>
					<li><a href="#" title="Articles">Articles</a></li>
					<li><a href="#" title="Add article">Add article</a></li>
					<li><a href="#" title="Posts">Posts</a></li>
					<li><a href="#" title="Add post">Add post</a></li>
				</ul>
			</li>
			<li class="comments"><a href="#" title="Comments">Comments</a>
				<ul>
					<li><a href="#" title="Manage">Manage</a></li>
					<li><a href="#" title="Spams">Spams</a></li>
				</ul>
			</li>
			<li class="medias"><a href="#" title="Medias">Medias</a>
				<ul>
					<li><a href="#" title="Browse">Browse</a></li>
					<li><a href="#" title="Add file">Add file</a></li>
					<li><a href="#" title="Manage">Manage</a></li>
					<li><a href="#" title="Settings">Settings</a></li>
				</ul>
			</li>
			<li class="users"><a href="#" title="Users">Users</a>
				<ul>
					<li><a href="#" title="Browse">List</a></li>
					<li><a href="#" title="Add user">Add user</a></li>
					<li><a href="#" title="Settings">Settings</a></li>
				</ul>
			</li>
			<li class="stats"><a href="#" title="Stats">Stats</a></li>
			<li class="settings"><a href="#" title="Settings">Settings</a></li>
			<li class="backup"><a href="#" title="Backup">Backup</a></li>
		</ul>
	</nav>   -->
	<!-- End main nav -->
	
	<!-- Sub nav -->
	<?php echo $this->element('header/sub_nav'); ?>
	<!-- End sub nav -->
	
	<!-- Status bar --> 
	<?php echo $this->element('header/status_bar'); ?>
	<!-- End status bar -->
	
   <!-- <div id="header-shadow"></div>  -->
	<!-- End header -->
	
	<!-- Always visible control bar --> 
	<?php echo $this->element('header/control_bar'); ?> 
	<!-- End control bar -->                            
	
	<!-- Content --> 
	<article class="container_12">
		<?php echo $content_for_layout; ?>  
	</article>
	<!-- End content -->              
	
	<?php echo $this->element('footer'); ?>

<!--[if lt IE 8]></div><![endif]-->
<!--[if lt IE 9]></div><![endif]-->
</body>
</html>