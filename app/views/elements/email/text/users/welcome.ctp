<?php echo sprintf(__('Hi %s', true), $data['User']['username']); ?>

<?php echo sprintf(__('Welcome to %s!  Now that you\'re here, we would like to invite you to test drive the site', true), $appConfigurations['name']); ?>

*<a href="<?php echo $appConfigurations['url']; ?>/users/profile" title="<?php echo __('Update your profile', true); ?>"><?php echo __('Update your profile', true); ?></a>: <?php __('Add a photo and link to your blog, facebook or Twitter profile.', true); ?>

<?php echo __('Thanks for joining us', true); ?>