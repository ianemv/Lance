<?php $sponcers = $this->requestAction('/sponcers/getsponcers'); ?>
<div id="logos" class="wrap">  
	<h2><?php echo __('These companies have helped us make dreams come true:', true); ?></h2>
 	<?php foreach ($sponcers as $sponcer):?> 
	 	<?php echo $html->link($html->image('sponcers/'.$sponcer['Sponcer']['image'], array('alt' => $sponcer['Sponcer']['name'])), $sponcer['Sponcer']['link'], array('escape' => false))?>    	
	<?php endforeach;?>
</div>