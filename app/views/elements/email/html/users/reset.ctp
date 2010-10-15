<style>
	.title {color: #61B8D9;}
	.subtitle {}
	.hint {font-size: 11px;}
	p {padding:10px 0;}
	a {color: ;}
</style>

<p><?php echo sprintf(__('Si olvidaste tu contraseña, puedes cambiarla ingresando en el siguiente enlace: %s', true), $data['User']['reset_link']); ?></p>   

<p><?php echo sprintf(__('Si no puedes hacer click en el link, puedes copiar y pegarlo en tu ventana del navegador, para seguir con la votación. Link para copiar: %s',true), $data['User']['reset_link']) ?></p> 

<p class="hint"><?php echo sprintf(__('Si usted no pidió el cambio de contraseña, por favor omita este Email.', true), $appConfigurations['name'])?>   
	
<p class="hint"><?php echo sprintf(__('Contacto: %s', true), $appConfigurations['email']); ?></p>


