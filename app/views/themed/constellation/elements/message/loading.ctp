<p class="message loading <?php echo ($class)?$class:""; ?>"> 
<?php if (!empty($close) && $close == true): ?> 
	<?php echo $html->tag('span', "", array('class' => 'close-bt')); ?>
<?php endif ?>
<?php echo $message; ?>
</p>