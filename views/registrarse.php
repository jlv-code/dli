<?php 

	session_start();

	if (!empty($_SESSION))
		header('location:index.php?p=ingresardli')

?>

<div class="wrap-form">
	<form id="new-user-form" name="new-user-form" method="post">
		<div class="field">
			<label>Cédula de Identidad</label>
			<input type="text" placeholder="Cédula de Identidad">
		</div>
		<div class="field">
			<label>Apellidos</label>
			<input type="text" placeholder="Apellidos">
		</div>
		<div class="field">
			<label>Nombres</label>
			<input type="text" placeholder="Nombres">
		</div>
		<div class="field">
			<label>Contraseña</label>
			<input type="password" placeholder="Contraseña">
		</div>
		<div class="field">
			<label>Repetir Contraseña</label>
			<input type="password" placeholder="Repetir Contraseña">
		</div><div class="field">
			<input type="submit" value="Registrarse">
		</div>
	</form>
</div>