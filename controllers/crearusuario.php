<?php 

	session_start();

	require '../modules/bd.php';
	require '../modules/usuarios.php';

	$data = $_SESSION['newuser'];
	unset($_SESSION['newuser']);

	$db = new db();
	$user = new users($data);
	$usercreated = $user->createuser();

	if (!$usercreated):
		$_SESSION['msg_err'] = "Ocurrió un error con el registro.";
		header('location:../index.php?p=registrarse');
		exit;
	endif;

	$_SESSION['msg_err'] = "Usuario registrado exitosamente!.";
	header('location:../index.php?p=registrarse');

?>