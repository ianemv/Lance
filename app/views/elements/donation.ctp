<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() {
        $('#donar').facebox();
    }); 
<?php echo $javascript->blockEnd(); ?>

<div id="plaza_container">
    <?php echo $html->image('mensaje_a_donar.png', array('alt' => __('I want to make this dream happen', true))); ?>
    <?php echo $html->link($html->image('btn_donar.png', array('alt' => __('I want to donate now!', true))), array('controller' => 'donations', 'action' => 'add'), array('id' => 'donar', 'escape' => false)); ?>
    <?php echo $html->image('metodospago.png', array('alt' => __('Payment Methods', true), 'id' =>'metodo_pago')); ?>
</div>
<?php echo $this->element('home_carousel'); ?>
