<?php
$html->script(array('jquery/jquery.autocomplete'), array('inline' => false));
?>
<?php echo $javascript->codeBlock(); ?>
	$(document).ready(function() { 
		$("#PlazaSchoolId").autocomplete('<?php echo $html->url(array('controller' => 'schools', 'action' => 'schools', 'ext' => 'json'))?>', {
				minChars: 0,
				width: 310,
				matchContains: "word",
				autoFill: false,
				formatItem: function(row, i, max) {   
					console.log(row);
					return i + "/" + max + ": \"" + row.name + "\" [" + row.location + "]";
				},
				formatMatch: function(row, i, max) { 
					return row.name + " " + row.location;
				},
				formatResult: function(row) {    
					return row.name;
				}
			});
		 
	});
<?php echo $javascript->blockEnd(); ?>
	<div class="author in">
		<h2><?php printf(__('Admin Add %s', true), __('Plaza', true)); ?></h2>
		<p></p>
	</div>
	
	<div class="line"></div>
	
	<div class="plazas forms in">

<?php echo $this->Form->create('Plaza', array('type' => 'file', 'autocomplete' => 'off'));?>
	<fieldset>
        <legend><?php printf(__('Plaza %s', true), __('Information', true)); ?></legend>
	<?php
		echo $this->Form->text('school_id', array('label' => __('School'),'class' => 'autocomplete'));
		echo $this->Form->input('description');  
	    echo $this->Form->input('PlazaImage.0.image', array('type' => 'file')); 
	?>
	</fieldset>
<?php echo $this->Form->end(array('name' => __('Submit', true), 'class' => 'com_btn'));?>
</div>
