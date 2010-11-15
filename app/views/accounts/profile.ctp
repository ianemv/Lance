<h2 class="title"><?php echo __('Account Profile', true); ?></h2>  

<div id="left-col" class="account profile">
		<?php echo $form->create('Account', array('type' => 'file'));?>
		<?php echo $form->input('full_name', array('label' => array('text' => __('Full Name', true), 'class' => 'label-over')))?> 
		<?php echo $form->input('location', array('label' => array('text' => __('Current Location', true), 'class' => 'label-over'))); ?> 
		<?php echo $form->input('bio', array('label' => array('text' => __('About Yourself', true), 'class' => 'label-over')));?>
		<?php echo $form->input('date_of_birth', array('label' => array('text' => __('Birthday', true))))?>
		<?php echo $form->input('gender_id', array('label' => __('Gender', true)))?>
		<?php echo $form->end(__('Update Profile', true));?>
	<div class="profile_image" >
		<?php if (!empty($this->data['Account']['image'])): ?> 
			<?php echo $html->image('profile/140/'. $this->data['Account']['image'])?> 
			<?php echo $html->div('image_delete', __('Delete Image', true)); ?>
		<?php else: ?>
			<?php echo $html->image('no_photo.png', array('alt' => __('No Profile Photo', true)))?>
		<?php endif; ?>
	</div>                 
</div>
<div id="right-col">
   <?php echo $this->element('account_menu'); ?>
</div> 
<div class="clear"></div>