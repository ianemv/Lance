<?php
$html->script(array('jquery/jquery.autocomplete'), array('inline' => false));
?>
<?php echo $javascript->codeBlock(); ?>
	$(document).ready(function() {
		$("#PlazaSchoolId").autocomplete('<?php echo $html->url(array('controller' => 'schools', 'action' => 'schools', 'ext' => 'json'))?>');
		
	});
<?php echo $javascript->blockEnd(); ?>
	<div class="author in">
		<h2><?php printf(__('Admin Add %s', true), __('Plaza', true)); ?></h2>
		<p></p>
	</div>
	
	<div class="line"></div>
	
	<div class="plazas forms in">

<?php echo $this->Form->create('Plaza', array('autocomplete' => 'off'));?>
	<fieldset>
        <legend><?php printf(__('Plaza %s', true), __('Information', true)); ?></legend>
	<?php
		echo $this->Form->text('school_id', array('label' => __('School'),'class' => 'autocomplete'));
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(array('name' => __('Submit', true), 'class' => 'com_btn'));?>
</div>
