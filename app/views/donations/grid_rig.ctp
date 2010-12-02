<?php echo $javascript->link('jquery/jquery.imjqmosaic.js', false)?> 
<div id="grid"></div>
<?php echo $javascript->codeBlock(null); ?>
    $(document).ready(function() { 
	 	
		
    }); 

	$.imJQMosaic({
		image:'/img/plaza_bg.png',
		target: 'grid',
        frameWidth: '920',
		frameHeight:'440',
		numberOfTilesX: '25', //25
		numberOfTilesY: '42', //40
		tileBorder: '1',
		tileBorderColor: '#609731',
		tileBorderRadius: '0',
		effectIntensity: '0.4',
		effectColor: '#c6e346'
   		},{
			menuUrl: '<?php echo $html->url(array('controller' => 'donations', 'action' => 'add'));?>'
		});
<?php echo $javascript->blockEnd(); ?>