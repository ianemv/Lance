	<div class="author in">
		<h2><?php printf(__('Admin Edit %s', true), __('Plaza', true)); ?></h2>
		<p></p>
	</div>
	
	<div class="line"></div>
	
	<div class="plazas forms in">

<?php echo $this->Form->create('Plaza', array('type' => 'file'));?>
	<fieldset>
        <legend><?php printf(__('Plaza %s', true), __('Information', true)); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('school_id');
		echo $this->Form->input('description'); 
		echo $this->Form->input('PlazaImage.0.image', array('type' => 'file'));   
	?>
	</fieldset>
<?php echo $this->Form->end(array('name' => __('Submit', true), 'class' => 'com_btn'));?>
</div>
