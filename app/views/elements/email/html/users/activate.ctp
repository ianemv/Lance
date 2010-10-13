<html>
<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
	<style>
   		.title {color: #61B8D9;}
		.subtitle {}
		.hint {font-size: 11px;}
		p {padding:10px 0;}
		a {color: ;}
	</style>  
	<h1 class="title"><?php echo sprintf(__('Hola %s', true), $data['User']['username']); ?></h1>
    <h2><?php echo __('Gracias por participar en el proyecto REGALA UNA PLAZA.', true); ?></h2> 
	<p><?php echo sprintf(__('Para votar por tu plaza(s) favorita(s) necesitas confirmar tu Email, haciendo click en el siguiente link: %s 
	Automaticamente vas a volver a la página de votación. Puedes votar un máximo de 10 veces, una vez al día.', true), $data['User']['activate_link']);?> </p>
	<p><?php echo __('Si no puedes hacer click en el link, puedes copiar y pegarlo en tu ventana del navegador, para seguir con la votación.', true); ?></p>
	<p><?php echo sprintf(__('Link para copiar: %s', true), $data['User']['activate_link']); ?></p>
	<p class="hint"><?php echo sprintf(__('Si no creaste una cuenta en "%s", por favor omitir este Email. Contacto: %s', true), $appConfigurations['name'], $appConfigurations['email'])?>
	
</body>
</html>