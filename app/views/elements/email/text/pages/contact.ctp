<?php echo sprintf(__('%s', true), $appConfigurations['name']);?>\n

<?php echo __('Alguien está tratando de contactar a través del formulario de contacto.', true);?>:\n

<?php echo __('Nombre', true);?>: <?php echo $data['Page']['first_name'] . " " , $data['Page']['last_name'] ?>\n

<?php echo __('Mail', true);?>: <?php echo $data['Page']['email']; ?>\n

<?php if(!empty($data['Page']['phone'])) : ?>
        <?php echo __('Telefono', true);?>: <?php echo $data['Page']['phone']; ?>\n
<?php endif; ?>

<?php echo __('Mensaje', true);?>:\n

<?php echo $data['Page']['message']; ?>