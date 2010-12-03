<?php echo $javascript->link('jquery/jquery.imjqmosaic.js', false)?> 
<?php echo $javascript->codeBlock(null, array('inline' => false)); ?>
    $(document).ready(function() {
        $('#donar').colorbox({opacity:0.55, onComplete:function(){$(".corner").corner();$('.required label').labelOver('label-over');}}); 
		$.ajax({  
			url:'<?php echo $html->url(array('controller' => 'donations', 'action' => 'grid'))?>',
			success: function(data) {
				$(".grid_loading").hide();
				$('#plaza_grid').html(data);
				$.getJSON('<?php echo $html->url(array('controller' => 'donation_meters', 'action' => 'meters')); ?>', function(data) { 
					$.each(data, function(i, meter) {
			  			$("#imjqmosaic_tile_"+meter).addClass('imjqmosaic_tile_active');
						$("#imjqmosaic_tile_"+meter+" a").removeClass('donate').attr('rel', 'tooltip');
					}); 
				})
				$(".imjqmosaic_tile a.donate").colorbox({opacity:0.55, onComplete:function(){$(".corner").corner();$('.required label').labelOver('label-over');}});
			} 
		});
    }); 
<?php echo $javascript->blockEnd(); ?>           
<div id="plaza_container_grid"> 
	<div class="grid_head">
		<div class="title"><?php echo sprintf(__('Nos faltan %s m para construir la mejor plaza', true), $html->tag('span', '100.000', array('id' => 'gdcount')))?></div>
		<?php echo $html->link($html->image('btn_donation_long.png', array('alt' => __('¡Quiero donar ahora!', true))), array('controller' => 'donations', 'action' => 'add'), array('id' => 'donar', 'style' => 'top: 0px;right:0px', 'escape' => false)); ?>
	</div>    
	<div class="grid_loading"><?php echo $html->image('loading_lg.gif', array()); ?><p><?php echo __('Cargando Plaza... eserpa un momento', true); ?></p></div>
	<div id="plaza_grid" class="corner">
		<?php echo $html->image('plaza_load.png', array('alt' => ''))?>
		
	</div>
</div> 

 
<?php echo $this->element('home_carousel'); ?>  





