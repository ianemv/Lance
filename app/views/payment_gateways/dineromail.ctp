<div class="payment-redirect">
	<div style="margin:10px 10px;"> 
		<h2><?php echo sprintf(__('Por favor, espere mientras le enviamos a %s', true), $html->image('sponcers/753cc75b9a885680051ad036cfdb8070cc885877.png', array('alt' => __('DineroMail', true)))); ?></h2>
		<?php echo $dineromail->submit(__('Haga clic aquí si esta página aparece durante más de 5 segundos', true), $dineroMailData); ?>
		<?php echo $javascript->codeBlock(); ?> 
			document.getElementById('frmDineroMail').submit();
		<?php echo $javascript->blockEnd(); ?>             
	</div>
</div>