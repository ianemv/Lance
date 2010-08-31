<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() {
        $('#donar').click(function() {
            $.facebox({div: '#formDonation'});
			return false;
        });
    }); 
        var donate = function() {
            $.ajax({
                url: "<?php echo $html->url(array('controller' => 'donations', 'action' => 'donate')); ?>",
                type: "POST",
                data: $('#formDonation').serialize(),
                success: function(data) {
                    alert(data);
                },
                error: function() {}
            });
        }
<?php echo $javascript->blockEnd(); ?>

<div id="plaza_container">
    <?php echo $html->image('mensaje_a_donar.png', array('alt' => __('I want to make this dream happen', true))); ?>
    <?php echo $html->link($html->image('btn_donar.png', array('alt' => __('I want to donate now!', true), 'id' => 'donar')), array('controller' => 'donations', 'action' => 'donate'), array('escape' => false)); ?>
    <?php echo $html->image('metodospago.png', array('alt' => __('Payment Methods', true), 'id' =>'metodo_pago')); ?>
</div>
<?php echo $this->element('home_carousel'); ?>
<div 
<?php
    echo $form->create('Donation', array('action' => 'donate', 'style' => 'display:none', 'id' => 'formDonation', 'onSubmit' => 'donate();return false;'));
    echo $form->input('first_name', array('label' => __('First Name', true))); 
    echo $form->input('last_name', array('label' => __('Last Name', true)));
    echo $form->input('rut', array('label' => __('RUT', true)));
    echo $form->input('email', array('label' => __('Email', true)));
    echo $form->input('twitter', array('label' => __('Twitter', true),'class' => 'twitter'));
    echo $form->input('message', array('type' => 'textbox', 'label' => __('Message', true)));
    echo $form->end('Submit'); 
?>
<!-- <form id="formadd" style="display:none">
            <label>

                Nombres <span class="detail red">( requerido )</span>
                <input type="text" name="first_name" id ="first_name" class="input required" />
            </label>
            <label>
                Apellidos <span class="detail red">( requerido )</span>
                <input type="text" name="last_name" id ="last_name" class="input required" />
            </label>

            <label>
                RUT <span class="detail red">( requerido )</span>
                <input type="text" name="rut" id ="rut" class="input required rut" />
            </label>
            <label>
                Email <span class="detail red">( requerido )</span>
                <input type="text" name="email" id ="email" class="input required email" />

            </label>
            <label>
                Twitter <span class="detail">( Solo tu nick )</span>
                <input type="text" name="twitter" id="twitter" class="input twitter" />
            </label>
            <label>
                Quiero donar porque             <textarea id="message" name="message"></textarea>

                <div id="message-info">Te quedan 100 caracteres disponibles.</div>
            </label>

            <div class="center">
                <input id="enviar" type="button" value="Continuar" class="submit" onclick="adduser()"/>
            </div>
        </form>  -->

