<div class="block-border">
    	<?php echo $form->create('User', array('class' => 'block-content form')); ?>
	<h1><?php printf(__('Admin Edit %s', true), __('User', true)); ?></h1> 
	<div class="columns">
		<div class="col200pxL-left"> 
			<h2><?php printf(__('User %s', true), __('Information', true)); ?></h2>
	
			<ul class="side-tabs js-tabs same-height"> 
				<li><?php echo $html->link(__('User View', true), '#tab-user-view')?></li> 
				<li><?php echo $html->link(__('User Information', true), '#tab-user-info')?></li>
				<li><?php echo $html->link(__('Account Information', true), '#tab-account-info')?></li>
			</ul>
  		</div>
	    <div class="col200pxL-right">
			<div id="tab-user-view" class="tabs-content"  style="height:300px;">
				    asdf
			</div>
			<div id="tab-user-info" class="tabs-content" >

			</div>
			<div id="tab-account-info" class="tabs-content">
		
			</div>
  		</div>
 	</div>
  	<?php echo $form->end();?> 
</div>           
	               
