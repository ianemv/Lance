<?php echo $javascript->codeBlock(); ?>    
	$(document).ready(function() {          	
		$('#UserRecoverForm').submit(function(event) {
			// Stop full page load
			event.preventDefault();
			var email = $('#UserEmail').val();
			
			if (!email || email.length == 0) {
				$('#login-block').removeBlockMessages().blockMessage('Please enter your e-mail address', {type: 'warning'});
			} else {
				var submitBt = $(this).find('button[type=submit]');
				submitBt.disableBt();
				// Target url
				var target = $(this).attr('action'); 
               	if (!target || target == '') {
					// Page url without hash
					target = document.location.href.match(/^([^#]+)/)[1];
				}
				
				// Request  
				var data = $(this).serialize();  
				var sendTimer = new Date().getTime();   
				// Send
				$.ajax({
					url: target,
					dataType: 'json',
					type: 'POST',
					data: data,
					success: function(data, textStatus, XMLHttpRequest) {
						if (data.valid) {
							// Small timer to allow the 'cheking login' message to show when server is too fast
							var receiveTimer = new Date().getTime();
							if (receiveTimer-sendTimer < 500) {
								setTimeout(function() {
									document.location.href = data.redirect;
									
								}, 500-(receiveTimer-sendTimer));
							} else {
								document.location.href = data.redirect;
							}
						} else {
							// Message
							$('#login-block').removeBlockMessages().blockMessage(data.error || 'An unexpected error occured, please try again', {type: 'error'});
							submitBt.enableBt();
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						// Message
						$('#login-block').removeBlockMessages().blockMessage('Error while contacting server, please try again', {type: 'error'});
						submitBt.enableBt();
					}
				});
			}   
		})
	});
<?php echo $javascript->blockEnd(); ?>

<h1><?php echo $appConfigurations['name'] ?>::<?php echo __('Admin', true); ?></h1>
<div class="block-header"><?php echo __('Reset your password', true); ?></div>
<?php echo $form->create('User', array('controller' => 'users', 'action' => 'recover', 'class' => 'form')); ?>
		<p class="input-with-button"> 
			<?php echo $form->input('email', array('label' => array('text' => __('Enter your e-mail address', true)), 'div' => false)); ?>
			<?php echo $form->button(__('Send', true, array('type' => 'submit')))?>
		</p>
<?php echo $form->end(); ?>