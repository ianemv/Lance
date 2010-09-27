<?php echo $javascript->codeBlock(); ?>
	function processForm(request) {
		if (request == 'success') {
			
		}
	}
    $(document).ready(function() {
        $('label.label-over').labelOver('label-over');
        $('input #DonationAmount').blur(function() {
        alert($(this).val());
        });
    });
<?php echo $javascript->blockEnd(); ?>
<div style="padding:20px;">
    <div class="info" style="margin: 10px 0;">
        <h2><?php echo __('Ayudanos donando', true); ?></h2>
        <p style="padding: 5px 0;"><?php echo __('Ayudan a realizar este sueño', true); ?>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit scelerisque nunc, et viverra ligula tempus sit amet. Nam arcu tellus, pulvinar in adipiscing non, sodales id ante. Pellentesque placerat metus non quam lobortis quis posuere dolor feugiat. Maecenas justo nibh, suscipit facilisis rhoncus sed, varius at velit.
        </p>
    </div>

<?php
    echo $ajax->form(array('type' => 'post', 'options' => array('id' => 'formDonation', 'model' => 'Donation', 'url' => array('controller' => 'donations', 'action' => 'donate'), 'dataType' => 'json', 'success' => 'processForm(request);')));

    echo $form->input('first_name', array('label' => array('text' => __('Nombre', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0; width:400px')); 
    echo $form->input('last_name', array('label' => array('text' => __('Apellido', true),'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:400px'));
    echo $form->input('email', array('label' => array('text' => __('Tu mail', true), 'class' => 'label-over'), 'style' => 'margin:0 0 10px 0;width:400px', 'class' => 'validate-email', 'id' => uniqid('email_')));
    echo $form->input('amount', array('type' => 'text', 'label' => array('text' => __('¿Cuántos metros quieres regalar?', true), 'style' => 'font-weight:bold;width:275px'), 'length' => 3, 'style' => 'position:static;display:inline;width:35px', 'between' => '&nbsp;', 'after' => $html->tag('span', $html->tag('strong', sprintf(__(' x $%s', true), $appConfigurations['donations']['cost'])))));
    echo $form->end(); 
?>      
    <div class="input" style="padding-left:185px;margin:20px;">
        <?php echo $html->tag('span', __('Total:', true), array('class'=>'font2')); ?>
        <?php echo $html->tag('span', '$0,000', array('class' => 'font1', 'id' => 'donation_total', 'style'=>'padding-left:55px;')); ?>
    </div>
    <div style="padding-left:75px;">
        <?php echo $html->link($html->image('btn_donar.png', array('alt' => __('¡Quiero donar ahora!', true))), array('controller' => 'donations', 'action' => 'add'), array('escape' => false));  ?>
    </div>
</div>

