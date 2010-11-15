<div class="block-border">       
	<?php echo $form->create('Page', array('class' => 'block-content form')); ?>  
	<h1><?php printf(__('Add New %s', true), __('Page', true)); ?></h1> 
	<div class="columns">
		<div class="col200pxL-left"> 
			<h2><?php printf(__('Page %s', true), __('Information', true)); ?></h2>
	
			<ul class="side-tabs js-tabs"> 
				<li><?php echo $html->link(__('General Information', true), '#tab-general-info')?></li>
				<li><?php echo $html->link(__('Meta Data', true), '#tab-meta-data')?></li>
			</ul>
  		</div>
	    <div class="col200pxL-right">
			<div id="tab-general-info" class="tabs-content">
				<?php  
					echo $form->input('id'); 
					echo $form->input('name', array()); 
					echo $form->input('title', array()); 
					echo $form->input('active', array('class' => 'switch'));             
					echo $form->input('content', array('class' => 'full-width'));             
				?>
			</div>
			<div id="tab-meta-data" class="tabs-content">
		     	 <?php
					echo $form->input('meta_keywords', array('label' => __('Keyword', true), 'class' => 'full-width')); 
					echo $form->input('meta_description', array('label' => __('Description', true), 'class' => 'full-width'));               
				?>     
			</div>
  		</div>    
		<div class="col200pxL-bottom">
			<p class="one-line-input grey-bg small-margin">
				<?php echo $form->input('top_show', array('label' => array('text' => __('Show top', true), 'class' => 'float-left'), 'div' => false, 'class' => 'mini-switch'))?>
			</p>
			<p class="one-line-input grey-bg small-margin">
				<?php echo $form->input('bottom_show', array('label' => array('text' => __('Show bottom', true), 'class' => 'float-left'), 'div' => false, 'class' => 'mini-switch'))?>
			</p>       
		</div>
 	</div>  
  	<fieldset class="grey-bg no-margin">
		<legend>Action on create</legend>
		<p class="input-with-button">
			<label for="simple-action">Select action</label>
			<select name="simple-action" id="simple-action">
				<option value="1">Save and publish</option>
				<option value="2">Save only</option>

			</select>
			<?php echo $form->button(sprintf(__('Create %s', true), __('Page', true)), array())?>   
		</p>
	</fieldset>
  	<?php echo $form->end();?> 
</div>