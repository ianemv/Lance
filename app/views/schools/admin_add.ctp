	<div class="author in">
		<h2><?php printf(__('Admin Add %s', true), __('School', true)); ?></h2>
		<p></p>
	</div>
	
	<div class="line"></div>
	
	<div class="schools forms in">

<?php echo $this->Form->create('School');?>
	<fieldset>
        <legend><?php printf(__('School %s', true), __('Information', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('image');
		echo $this->Form->input('lat');
		echo $this->Form->input('long');
	?>
	</fieldset>
<?php echo $this->Form->end(array('name' => __('Submit', true), 'class' => 'com_btn'));?>
</div>
