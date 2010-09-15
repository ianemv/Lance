<div id="top_menu">     
	<?php echo $html->link($html->image('home.png', array('alt' => __('Home', true))), '/', array('escape' => false, 'style' => 'float:left')); ?>
	<ul class="menu"> 
		<li><?php echo $html->link(__('The Project', true), '/'); ?></li>
		<li><?php echo $html->link(__('Votar por una plaza', true), '/'); ?></li>
		<li><?php echo $html->link(__('Como Donar?', true), '/'); ?></li>
		<li><?php echo $html->link(__('Difunde', true), '/'); ?></li>
		<li class="last"><?php echo $html->link(__('Prensa', true), '/'); ?></li>
	</ul>    
</div>