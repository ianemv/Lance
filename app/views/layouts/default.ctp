<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> ::
		<?php echo $appConfigurations['name']; ?>
	</title>
	<?php
		if(!empty($meta_description)) :
			echo $html->meta('description', $meta_description);
		endif;
		if(!empty($meta_keywords)) :
			echo $html->meta('keywords', $meta_keywords);
		endif;
		echo $html->css('reset');
        echo $html->css('main');
        echo $html->css('/js/jquery/jquery.jcarousel/jquery.jcarousel.skin');
        echo $html->css('/js/facebox/facebox.css');
    ?>
    <!--[if IE]>
        <?php echo $javascript->link('http://html5shiv.googlecode.com/svn/trunk/html5.js'); ?>
    <![endif]-->
    <!--[if lte IE 7]>
        <?php echo $javascript->link('IE8'); ?>
    <![endif]-->
    <!--[if lt IE 7]>
        <?php echo $html->css('ie6.css'); ?>
    <![endif]-->
    
    <?php
		echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
        echo $javascript->link('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');
        echo $javascript->link('jquery/jquery.hoverIntent.min');
		echo $javascript->link('jquery/jquery.jcarousel/jquery.jcarousel.min');
        echo $javascript->link('jquery/jquery.corner');
	#	echo $javascript->link('index');
        echo $javascript->link('facebox/facebox');
		echo $scripts_for_layout;
	?>
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
        });
    <?php echo $javascript->blockEnd(); ?>

</head>
<body>
    <div class="full header1">
        <div class="wrap">
            <?php echo $html->image('logo_charitybox.png', array('alt' => __('Charity Box', true), 'id' => 'logo1')); ?>
            <?php echo $html->image('fundacionmustaki.png', array('alt' => __('Mustaki Foundation', true), 'id' => 'logo2')); ?>
        </div>
    </div>
    <div class="full header2">
        <div class="wrap">
            <div class="header2_1">
                <?php echo __('The children dream it, and we\'ll build it.  We need your donation, to make the dream a reality.', true); ?>
            </div>
            <div class="header2_2">
                <ul>
                    <li><?php echo $html->image('paso1.png', array('alt' => __('Step 1', true))); ?></li>
                    <li><?php echo $html->image('paso2.png', array('alt' => __('Step 2', true))); ?></li>
                    <li><?php echo $html->image('paso3.png', array('alt' => __('Step 3', true))); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="main_content" class="wrap">
        <?php echo $this->element('donation'); ?>

			<div id="votacion_container">
				<h2>Estas son algunas de las plazas</h2>
				<div class="line"></div>
				<div id="votacion_container_left" class="font">
					<p>Entre junio y agosto del año 2010, fueron cientos los colegios que participaron en el concurso de construcción con piezas de Lego para realizar <b>"Mi mejor plaza de juegos"</b>.</p>
					<p>Esta es la última y más importante etapa del proyecto. Es aquí donde todos tenemos la oportunidad de hacer realidad el sueño de los niños. Poder construir a escala real en 1.000m&sup2; el proyecto ganada de "mi mejor plaza de juegos"</p>
					<div id="votar_button"><a href="#">Quiero elegir la mejor plaza de juegos</a></div>
				</div>
				<div id="votacion_container_right">
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
				</div>
			</div>
        </div> 
        <?php echo $content_for_layout; ?>
		<div class="footer">
			<div class="wrap">
				<div id="up">
                    <?php echo $html->link($html->image('1.jpg', array('alt' => '')), array(), array('escape' => false)); ?>
				</div>
                <?php echo sprintf(__('Give a Park is a %s project with help from %s', true), $html->link(__('Charitybox', true), array()), $html->link(__('Digitales x Chile', true), array())); ?>
                <?php echo $this->element('footer_menu'); ?>
			</div>
		</div>
    </div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>
