<?php 

	/*
	VISTA RESGISTRASE

	Esta vista se encarga de mostrar un formulario con los datos
	basicos para que un usuario se registre
	*/
	
	session_start();

	/*
	Verificacion de usuario logeado
	*/

	if ($_SESSION['userid']!='')
		header('location:?p=testdli');

	/*
	Se almacenan los datos en una variable de sesion para luego ser verificados
	que no esten vacios y luego enviados al controlador de rearusuario.php.

	Si algun campo esta vacio la vista dara un mensaje respectivo, de estar todo bien
	envia los datos al controlador para procesarlos.
	*/

	if ($_POST){
		$_SESSION['newuser'] = $_POST;
		if ($_SESSION['newuser']['cedula']!='' && 
			$_SESSION['newuser']['apellidos']!='' &&
			$_SESSION['newuser']['nombres']!='' &&
			$_SESSION['newuser']['clave']!='' &&
			$_SESSION['newuser']['repetirclave']!='')
			if ($_SESSION['newuser']['clave']==$_SESSION['newuser']['repetirclave'])
				header('location:controllers/crearusuario.php');
			else
				$msg_err = 'Los campos: Contraseña y Repetir Contraseña deben ser iguales.';
		else
			$msg_err = 'Todos los campos del formulario son obligatorios.';
	}

?>

<!--
Aqui se muestra todo el HTML necesario para el registro del usuario.
-->

<div class="wrap-form">
	<form id="new-user-form" name="new-user-form" method="post">
		<div class="field">
			<label>Cédula de Identidad</label>
			<input type="text" name="cedula" placeholder="Cédula de Identidad">
		</div>
		<div class="field">
			<label>Apellidos</label>
			<input type="text" name="apellidos" placeholder="Apellidos">
		</div>
		<div class="field">
			<label>Nombres</label>
			<input type="text" name="nombres" placeholder="Nombres">
		</div>
		<div class="field">
			<label>Contraseña</label>
			<input type="password" name="clave" placeholder="Contraseña">
		</div>
		<div class="field">
			<label>Repetir Contraseña</label>
			<input type="password" name="repetirclave" placeholder="Repetir Contraseña">
		</div>
		<div class="field">
			<input type="submit" value="Registrarse">
		</div>
		<div class="field" style="color:#fff;">
			<?php 
				print ($msg_err)?$msg_err:$_SESSION['msg_err'];
				unset($_SESSION['msg_err']);
			?>
		</div>
	</form>
</div>	