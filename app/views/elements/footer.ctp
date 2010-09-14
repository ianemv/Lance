<div id="footer">
	<div class="wrap">
		<div id="up">
            <?php echo $html->link($html->image('btn_subir.png', array('alt' => '')), array(), array('escape' => false)); ?>
		</div>
        <?php echo $html->div('es_de', sprintf(__('Give a Park is a %s project with help from %s', true), $html->link(__('Charitybox', true), array()), $html->link(__('Digitales x Chile', true), array()))); ?>
        <?php echo $this->element('footer_menu'); ?>
	</div>
</div>
