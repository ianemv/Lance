<div id="top_menu">     
	<?php echo $html->link($html->image('home.png', array('alt' => __('Home', true))), '/', array('escape' => false, 'style' => 'float:left')); ?>
	<ul class="menu"> 
		<!--<li><?php echo $html->link(__('El proyecto', true), '/proyecto'); ?></li>    -->
		<li><?php echo $html->link(__('Votar por una plaza', true), '/plazas'); ?></li>
	   <!-- <li><?php echo $html->link(__('¿Como Donar?', true), '/como'); ?></li> -->
	   <!-- <li><?php echo $html->link(__('Difunde', true), '/difunde'); ?></li>  -->
	   <!-- <li class="last"><?php echo $html->link(__('Prensa', true), '/prensa'); ?></li>   -->
	</ul>    
</div>
