<?php 

	session_start();

	require '../modules/bd.php';
	require '../modules/usuarios.php';

	$data = $_SESSION['login'];
	unset($_SESSION['login']);

	$db = new db();
	$user = new users($data);
	$userverified = $user->verifyuser();

	if (!$userverified):
		$_SESSION['msg_err'] = "El usuario que intenta acceder no existe.";
		header('location:../index.php?p=ingresardli');
		exit;	
	endif;

	$_SESSION['userid'] = $userverified[0]['cedula'];
	header('location:../index.php?p=testdli');

?>