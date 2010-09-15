	<div class="author in">
		<h2><?php printf(__('Admin Add %s', true), __('Sponcer', true)); ?></h2>
		<p></p>
	</div>
	
	<div class="line"></div>
	
	<div class="sponcers forms in">

<?php echo $this->Form->create('Sponcer', array('type' => 'file'));?>
	<fieldset>
        <legend><?php printf(__('Sponcer %s', true), __('Information', true)); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('link');   
		echo $this->Form->input('show_order');
		echo $this->Form->input('image', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(array('name' => __('Submit', true), 'class' => 'com_btn'));?>
</div>
