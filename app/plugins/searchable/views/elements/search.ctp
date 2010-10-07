<?php echo $html->script('jquery/jquery.autocomplete', array('inline' => true))?>
<div id="searchform">
	<?php echo $form->input('query', array('type' => 'text', 'label' => __('Busca tu plaza', true), 'before' => $html->tag('span', $html->image('loading-sml.gif', array('alt' => __('Loading', true)."...")), array('id' => 'search-indicator', 'class' => 'autocomplete-indicator', 'style' => 'display:none')), 'id' => 'query', 'class' => 'label-over search_box'))?>
	<?php echo $html->scriptStart(); ?> 
		$().ready(function() {  
			var options, a;
               	options = {
	                serviceUrl: '<?php echo $html->url(array('plugin' => 'searchable', 'controller' => 'search_indexes', 'action' => 'search', 'admin' => false))?>',
	                minChars: 2, 
					maxHeight: false,
	                indicator: 'search-indicator',
	                selectElement:getElementId,
	        };
	        $("#query").autocomplete(options);
	        function getElementId(li) {
	                location.href = $(li).attr('url');
	        }     
	});
	<?php echo $html->scriptEnd();?>
</div>