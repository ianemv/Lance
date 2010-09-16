<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() {
        $('#donar').facebox();
    }); 
<?php echo $javascript->blockEnd(); ?>

<div id="plaza_container">
    <?php echo $html->image('mensaje_a_donar.png', array('alt' => __('Quiero ayudar a cumplir esta lindo sueño.', true))); ?>
    <?php echo $html->link($html->image('btn_donar.png', array('alt' => __('¡Quiero donar ahora!', true))), array('controller' => 'donations', 'action' => 'add'), array('id' => 'donar', 'escape' => false)); ?>
    <?php echo $html->image('metodospago.png', array('alt' => __('Metodos de Pago', true), 'id' =>'metodo_pago')); ?>
</div>
<?php echo $this->element('home_carousel'); ?>
