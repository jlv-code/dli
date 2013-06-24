<?php 

	session_start();

?>
<div class="info">
	<p>Para ingresar al sistema debe introdir los siguientes datos en el formulario para logearse.
	Si no posee una cuenta puede registrarse.<br>
	<a class="registrarse" href="registrarse.php">Crear un Usuario</a></p>
</div>
<div class="new-session">
	<form id="new-session-form" name="new-session-form" method="post" action="controllers/login.php">
		<div class="field">
			<input type="text" placeholder="Usuario">
		</div>
		<div class="field">
			<input type="password" placeholder="Contraseña">
		</div>
		<div class="field">
			<input type="submit" value="Iniciar Sesión">
		</div>
	</form>
</div>