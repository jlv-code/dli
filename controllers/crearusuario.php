<?php 

	/*
	CONTROLADOR DE CREACION DE USUARIOS

	Este controlador se encarga de crear un nuevo usuario con 
	para permitir el logeo y realizar el Test.
	*/

	session_start();

	/*
	Se incluyen los metodos necesarios, Metodo de Base de Datos 
	y Metodo de Usuarios.
	*/

	require '../modules/bd.php';
	require '../modules/usuarios.php';

	/*
	Se obtinen los datos del nuevo usuario a traves de la variable de sesion
	y luego se vacia por seguridad
	*/

	$data = $_SESSION['newuser'];
	unset($_SESSION['newuser']);

	/*
	Se crean los objetos deBase de Datos y Usuarios
	*/

	$db = new db();
	$user = new users($data);

	/*
	Se llama al metodo de Creacion de Usuarios
	*/

	$usercreated = $user->createuser();

	/*
	Si hubo algun error en la insercion del usuario
	se emite un mensaje en la vista
	*/

	if (!$usercreated):
		$_SESSION['msg_err'] = "Ocurrió un error con el registro.";
		header('location:../index.php?p=registrarse');
		exit;
	endif;

	/*
	Si no hay ningun error en la insercion se da un mensaje de
	usuario registrado
	*/

	$_SESSION['msg_err'] = "Usuario registrado exitosamente!.";
	header('location:../index.php?p=registrarse');

?>