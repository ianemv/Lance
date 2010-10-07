<p><?php echo sprintf(__('%s', true), $appConfigurations['name']);?></p>
<p><?php echo __('Alguien está tratando de contactar a través del formulario de contacto.', true);?>:</p>
<p><?php echo __('Nombre', true);?>: <?php echo $data['Page']['first_name'] . " " , $data['Page']['last_name'] ?></p>

<p><?php echo __('Mail', true);?>: <?php echo $data['Page']['email']; ?></p>

<?php if(!empty($data['Page']['phone'])) : ?>
        <p><?php echo __('Telefono', true);?>: <?php echo $data['Page']['phone']; ?></p>
<?php endif; ?>

<p><?php echo __('Mensaje', true);?>:<br />
<?php echo nl2br($data['Page']['message']); ?></p>