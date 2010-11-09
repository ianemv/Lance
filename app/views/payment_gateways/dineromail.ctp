<div class="payment-redirect">
	<?php echo $dineromail->submit('', $dineroMailData); ?>
	<?php echo $javascript->codeBlock(); ?> 
		document.getElementById('frmDineroMail').submit();
	<?php echo $javascript->blockEnd(); ?>
</div>