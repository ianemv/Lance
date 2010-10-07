<div class="donations form">
<?php echo $this->Form->create('Donation');?>
	<fieldset>
 		<legend><?php __('Admin Add Donation'); ?></legend>
	<?php
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('rut');
		echo $this->Form->input('email');
		echo $this->Form->input('twitter');
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Donations', true), array('action' => 'index'));?></li>
	</ul>
</div>