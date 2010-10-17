<div style="float:right; margin: 0;">  
	<!--
	<?php if($session->check('Auth.User')):?>  
	<div style="width:350px;position:absolute;right:10px;top:5px;">      
		<div class="current-user">
		 	<dl>
	            <dt class="vote-count">0</dt>
	            <dd><?php echo $html->link(__('Votes', true), '#')?></dd>
	        </dl>
	        <div class="settings-menu">
	            <div class="settings-menu-top">
					<?php echo $html->link($html->image('http://cdn2.diggstatic.com/user/193308/r.3314294669.png', array('alt' => '')), array('controllers' => 'users', 'action' => 'view', 'username' => $session->read('Auth.User.username')), array('class' => 'current-user-thumbnail', 'escape' => false))?>
	                <?php echo $html->link($html->tag('span', '', array('class' => 'arrow')), '#', array('class' => 'settings-menu-toggle', 'escape' => false))?>                         	<div class="clear"></div>
	            </div>
	            <div class="settings-menu-dropdown">
	                <ul> 
						<li><?php echo $html->link(__('Settings', true), array('controller' => 'users'), array('id' => 'header-settings')); ?></li>
	                    <li><?php echo $html->link(__('Account', true), array('controller' => 'accounts', )); ?></li>
	                    <li><?php echo $html->link(__('Profile', true), array('controller' => 'accounts', 'action' => 'profile')); ?></li>
	                    <li><?php #echo $html->link(__('Notifications', true), '#'); ?></li>
	                    <li class="last"><?php echo $html->link(__('Logout', true), array('controller' => 'users', 'action' => 'logout'), array('id' => 'header-logout')); ?></li>
	                </ul>
	            </div>
	        </div>       
	   	</div>
	</div>
	<?php else: ?> 
	<div style="width:350px;position:absolute;right:10px;top:5px;">      
	  	<div class="login-join">
			<ul> 
				<li class="corner" style="background:#56bbea;"><?php echo $html->link(__('Regístrate', true), array('controller' => 'users', 'action' => 'register'))?></li>
				<li><?php echo $html->link(__('Entrar', true), array('controller' => 'users', 'action' => 'login'))?></li>
			</ul>   
		</div>
	 </div>  

	<?php endif; ?>   
-->
	<?php echo $this->element('search', array('plugin' => 'searchable')); ?>               
</div>