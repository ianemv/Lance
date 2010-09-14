<div class="donations form">
<?php echo $this->Form->create('Donation');?>
	<fieldset>
 		<legend><?php __('Admin Edit Donation'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Donation.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Donation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Donations', true), array('action' => 'index'));?></li>
	</ul>
</div>