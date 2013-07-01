<?php 

	/*
	VISTA DE INGRESAR A DLI

	Esta vista se encarga de mostrar un formulario de Inicio de Sesion 
	para usuarios registrados.

	Si no tienen usuarios los visitantes, existe un boton para registrar 
	un usuario.
	*/

	session_start();

	/*
	Verificacion de usuario loegado, en caso que exista un usuario logeado
	el sistema redirigira al usuario a la pantalla o vista del Test.
	*/

	if ($_SESSION['userid']!='')
		header('location:?p=testdli');

	if ($_POST){
		/*
		Se almacenn los datos del login en una variable de sesion para recatarla
		en el controlador login.php
		*/
		$_SESSION['login'] = $_POST;
		if ($_SESSION['login']['usuario']!='' && $_SESSION['login']['password']!='')
			header('location:controllers/login.php');
		else
			$msg_err = 'Deben introducir un usuario y una contraseña.';
	}

?>
<div class="info">
	<p>Para ingresar al sistema debe introdir los siguientes datos en el formulario para logearse.
	Si no posee una cuenta puede registrarse.<br>
	<a class="registrarse" href="?p=registrarse">Crear un Usuario</a></p>
</div>
<div class="new-session">
	<form id="new-session-form" name="new-session-form" method="post">
		<div class="field">
			<input type="text" name="usuario" placeholder="Usuario">
		</div>
		<div class="field">
			<input type="password" name="password" placeholder="Contraseña">
		</div>
		<div class="field">
			<input type="submit" value="Iniciar Sesión">
		</div>
		<div class="field" style="color:#fff;">
			<?php 

				/*
				En caso que exista un error, el controlador nos enviara cual es el error 
				encontrado y lo mostrara.
				*/
				print ($msg_err)?$msg_err:$_SESSION['msg_err'];
				unset($_SESSION['msg_err']);
			?>
		</div>
	</form>
</div>