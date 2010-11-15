<?php echo $javascript->codeBlock(); ?>    
	$(document).ready(function() {       
		// We'll catch form submission to do it in AJAX, but this works also with JS disabled
		$('#UserLoginForm').submit(function(event) { 
			// Stop full page load
			event.preventDefault();
			// Check fields
			var login = $('#UserUsername').val();
			var pass = $('#UserPassword').val();
			
			if (!login || login.length == 0) {
				$('#login-block').removeBlockMessages().blockMessage('Please enter your user name', {type: 'warning'});
			} else if (!pass || pass.length == 0) {
				$('#login-block').removeBlockMessages().blockMessage('Please enter your password', {type: 'warning'});
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

				var redirect = $('#redirect');
				if (redirect.length > 0) {
					data.redirect = redirect.val();
				}
				
				// Start timer
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
				// Message
				$('#login-block').removeBlockMessages().blockMessage('Please wait, cheking login...', {type: 'loading'});
			}	
		});
		
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
<div class="block-header"><?php echo __('Please login', true); ?></div>  
<?php
	if($session->check('Message.flash')){     
		echo $session->flash();
	}

	if($session->check('Message.auth')){
   		echo $session->flash('auth');
	}  
?>

<?php echo $form->create('User', array('controller' => 'users', 'action' => 'login', 'class' => 'form with-margin')); ?>
	<input type="hidden" name="a" id="a" value="send">
	<?php echo $form->input('username', array('label' => array('text' => $html->tag('span', __('User Name', true), array('class' => 'big'))), 'class' => 'full-width', 'div' => 'inline-small-label')); ?>
	<?php echo $form->input('password', array('label' => array('text' => $html->tag('span', __('Password', true), array('class' => 'big'))), 'class' => 'full-width', 'div' => 'inline-small-label')); ?>  
	<?php echo $form->button(__('Login', true), array('type' => 'submit', 'class' => 'float-right'))?>
	<p class="input-height"> 
		<?php echo $form->input('remember_me', array('type' => 'checkbox','label' => array('text' => __('Keep me logged in', true), 'class' => 'inline'), 'div' => false, 'class' => 'mini-switch'))?>
	</p>
<?php echo $form->end(); ?>

<?php echo $form->create('User', array('controller' => 'users', 'action' => 'recover', 'class' => 'form')); ?>
	<fieldset class="grey-bg no-margin collapse">
		<legend><?php echo $html->link(__('Lost password', true), '#'); ?></legend>
		<p class="input-with-button"> 
			<?php echo $form->input('email', array('label' => array('text' => __('Enter your e-mail address', true)), 'div' => false)); ?>
			<?php echo $form->button(__('Send', true, array('type' => 'submit')))?>
		</p>
	</fieldset>
<?php echo $form->end(); ?>