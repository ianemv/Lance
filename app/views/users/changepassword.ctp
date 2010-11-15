<h2 class="title"><?php echo __('Account Profile', true); ?></h2>  

<div id="left-col" class="account profile">
	<?php echo $form->create('User', array('url' => '/users/changepassword'));?>
	<p><?php __('To change your password enter in your old password and your new password twice.');?></p>
	<?php
		echo $form->input('old_password', array('value' => '', 'type' => 'password', 'label' => __('Old Password', true)));
		echo $form->input('before_password', array('value' => '', 'type' => 'password', 'label' => __('New Password', true)));
		echo $form->input('password_confirmation', array('value' => '', 'type' => 'password', 'label' => __('Password Confirmation', true)));
	?>
	<?php echo $form->end(__('Change Password', true));?>              
</div>
<div id="right-col">
   <?php echo $this->element('account_menu'); ?>
</div> 
<div class="clear"></div>










