<?php echo $this->element('sponcers'); ?>
<div id="footer">    
	<div class="wrap">
		<div id="up">
            <?php echo $html->link($html->image('btn_subir.png', array('alt' => __('Subir', true))), '', array('escape' => false)); ?>
		</div>
        <?php echo $html->div('es_de', sprintf(__('Regala una plaza es un proyecto de %s con el apoyo de %s', true), $html->link(__('Lego Charitybox', true), 'http://www.charitybox.cl'), $html->link(__('Digitales por Chile', true), 'http://www.didigital.cl'))); ?>
        <?php echo $this->element('footer_menu'); ?>
	</div>
</div>
