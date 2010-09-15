<?php echo $javascript->codeBlock(); ?>
    $(document).ready(function() {
        $('#votacion_container_right .marco').hoverIntent(
           function() {
               $(this).find(".vote_box").effect('slide', {direction:'up'}, 200);
               $(this).find('.vote_dialog').effect('bounce', {direction:'down'},200);
               $(this).find("img").fadeOut();
           },
           function() {
               $(this).find(".vote_box").fadeOut();
               $(this).find("img").fadeIn();
           }
       ); 
	   $("")
    });
<?php echo $javascript->blockEnd(); ?>
<?php $plazas = $this->requestAction('/plazas/getplazas/limit:1');  ?>

<div id="votacion_container">
	<h2><?php echo __('Estas son algunas de las plazas', true); ?></h2>
	<div class="line"></div>
	<div id="votacion_container_left" class="font">
		<p>Entre junio y agosto del año 2010, fueron cientos los colegios que participaron en el concurso de construcción con piezas de Lego para realizar <b>"Mi mejor plaza de juegos"</b>.</p>
		<p>Esta es la última y más importante etapa del proyecto. Es aquí donde todos tenemos la oportunidad de hacer realidad el sueño de los niños. Poder construir a escala real en 1.000m&sup2; el proyecto ganada de "mi mejor plaza de juegos"</p>
		<div id="votar_button"><?php echo $html->link(__('Quiero elegir la mejor plaza de juegos', true), array('controller' => 'plazas'))?></div>
	</div>
	<div id="votacion_container_right">
		<?php   
			if (!empty($plazas)) {
				foreach ($plazas as $plaza) {
		?>
		<div class="marco"> 
			<div class="clipwrapper">
				<div class="clip">   
					<?php if (!empty($plaza['PlazaImage'])): ?>
						<?php echo $html->image($plaza['PlazaImage'][0], array('alt' => '')); ?>
					<?php endif; ?>   
					<div class="vote_box" style="display:none">
						<div class="vote_dialog">
							<?php echo $html->tag('p', $plaza['School']['name']); ?>
					  	</div>
						<div class="vote_form"> 
							   <?php echo $form->input('email', array('label' => false))?>
							   <?php echo $html->link($html->image('btn_votar_plaza.png', array('alt' => __('Vote', true))), '#', array('class'=> 'btn_votar', 'escape' => false))?>
						</div> 
				  	</div>
				</div>
			</div>
		</div> 	  
		<?php		
				}                     
			} else {
				echo __('No Plazas found.', true);
			}
		?>
	</div>
</div>
<!--

<div class="marco">
    <div class="clipwrapper">
        <div class="clip">
        <img src="/img/paso2.png" alt=""/> 
            <div class="vote_box" style="display:none">
            <div class="vote_dialog">
                <p>This is the School</p>
            </div>
            <div class="vote_form">
            <form>
                <input type="text" name="email"/>
                <a href="#" class="btn_votar"><img src="/img/btn_votar_plaza.png" alt="Votar"></a>sdf
                asdfasd
            </form>
            </div>
            </div>
        </div>
    </div>
</div>


<div class="marco"><div class="clipwrapper"><div class="clip">
	<img src="/img/paso2.png" alt=""/>
</div></div></div>
<div class="marco"><div class="clipwrapper"><div class="clip">
	<img src="/img/paso2.png" alt=""/>
</div></div></div>
<div class="marco"><div class="clipwrapper"><div class="clip">
	<img src="/img/paso2.png" alt=""/>
 </div></div></div>
<div class="marco"><div class="clipwrapper"><div class="clip">
	<img src="/img/paso2.png" alt=""/>
</div></div></div>
<div class="marco"><div class="clipwrapper"><div class="clip">
	<img src="/img/paso2.png" alt=""/>
</div></div></div>


-->




