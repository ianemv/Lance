<div class="block-border"> 
	<?php echo $form->create('User', array('class' => 'block-content form')); ?> 
	<?php
	if($session->check('Message.flash')){     
		echo $session->flash();
	}
	?> 
	<h1><?php printf(__('Admin Add %s', true), __('User', true)); ?></h1>
	<fieldset>
		<legend><?php printf(__('User %s', true), __('Information', true)); ?></legend>
	<?php
		echo $form->input('username', array('label' => __('User Name', true)));
		echo $form->input('email', array('label' => __('Email', true)));
		echo $form->input('password_before', array('type' => 'password', 'label' => __('Password', true)));
		echo $form->input('password_confirmation', array('type' => 'password', 'label' => __('Password Confirmation', true)));
		echo $form->input('active', array('type' => 'checkbox', 'label' => array('text' => __('Active', true)), 'class' => 'switch'));
		echo $this->Form->input('group_id', array('label' => __('Group', true)));
	?> 
    </fieldset> 
	<fieldset class="grey-bg no-margin">
		<?php echo $form->button(__('Create', true), array('type' => 'submit')); ?>
	</fieldset> 
 	<?php echo $this->Form->end();?>      
</div>           
		     
