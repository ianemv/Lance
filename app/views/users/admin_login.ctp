<?php echo $form->create('User', array('action' => 'login')); ?>
    <?php 
        echo $form->input('username', array('label' => __('Username', true), 'class' => 'text-input'));   
	?>   
	<div class="clear"></div>
	<?php
        echo $form->input('password', array('label' => __('Password', true), 'class' => 'text-input'));
    ?>                       
	<div class="clear"></div> 
	<?php
		echo $form->input('remember_me', array('type' => 'checkbox', 'label' => false, 'div' => array('id' => 'remember_me'),'after' => __('Remember me', true)));
	?>                                                                                     
	<div class="clear"></div>
<?php echo $this->Form->end(array('name' => __('Login', true), 'class' => 'button'));?>
