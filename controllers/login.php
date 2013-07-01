<?php 

	/*
	CONTROLADOR DE LOGIN

	Este controlados se encarga de hacer una verificacion de usuario
	usando el modelo Usuarios para ver si existe y permitirle el logeo.
	*/

	session_start();

	/*
	Se incluyen los modelos relacionados, el de Base de Datos y 
	el de Usuarios.
	*/

	require '../modules/bd.php';
	require '../modules/usuarios.php';

	/*
	Se obtiene una variable de sesion con los datos del usuario que
	quiere logearse (usuario y clave) y luego se vacia esa variable de
	sesion por seguridad.
	*/

	$data = $_SESSION['login'];
	unset($_SESSION['login']);

	/*
	Se crean los objetos de ambos modelos, el de Base de Datos y el
	de Usuarios.
	*/

	$db = new db();
	$user = new users($data);

	/*
	Se llama a un metodo del modelo de Usuarios para hacer la 
	verificacion contra la base de datos para ver si existe.
	*/

	$userverified = $user->verifyuser();

	/*
	En caso que eciste algun error se prepara un mensaje para ello y 
	se redirecciona a la pantalla de logeo para que muestre el mensaje 
	a traves de la vista usuando una variable de sesion.
	*/

	if (!$userverified):
		$_SESSION['msg_err'] = "El usuario que intenta acceder no existe.";
		header('location:../index.php?p=ingresardli');
		exit;	
	endif;

	/*
	Si no hubo ningun error, se almacena en una variable de sesion el 
	usuario y se redirecciona a la pantalla del Test.
	*/

	$_SESSION['userid'] = $userverified[0]['cedula'];
	header('location:../index.php?p=testdli');

?>