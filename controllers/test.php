<?php 

	/*
	CONTROLADOR DEL TEST

	Este controlador se encarga de todos los datos que se muestran en 
	la vista del TEST.

	Este controlador se llama 2 veces:
	La primera vez se llama para poder obtener las preguntas y posibles
	respuestas que se van a mostrar en el TEST.
	La segunda vez se llama para evaluar los resultados del TEST.
	*/

	session_start();

	/*
	Verificacion de usuario logeado
	*/

	if ($_SESSION['userid']=='')
		header('location:index.php?p=ingresardli');

	/*
	Aqui entra por primera vez la vista para poder obtener las preguntas
	y respuestas
	*/

	if (!isset($_SESSION['test'])){

		/*
		Se incluyen los modelos de Base de Datos y TEST
		Estos modelos son Clases en PHP (Programacion Orientada a Objetos - POO)
		*/

		require 'modules/bd.php';
		require 'modules/testmodel.php';

		/*
		Se crean los obejetos
		*/

		$db = new db();
		$test = new test();

		/*
		Se construye el TEST
		*/

		$newtest = $test->maketest();

	}

	/*
	Aqui entra la vista por segunda vez para obtener los resultados del TEST
	*/

	if (isset($_SESSION['test'])){

		/*
		Se incluyen los modelos de Base de Datos y TEST
		Estos modelos son Clases en PHP (Programacion Orientada a Objetos - POO)
		*/
		
		require '../modules/bd.php';
		require '../modules/testmodel.php';

		/*
		Se crean los obejetos
		*/

		$db = new db();
		$test = new test();

		/*
		Se hace la verificacion de resultados
		*/

		$result = $test->verifytest($_SESSION['test']);

		$_SESSION['html'] = $result['html'];

		/*
		Se genera un mensaje de Aprobado o Reprobado dependiendo sea el caso
		*/

		if ($result['result']):
			$_SESSION['msg'] = '<span style="color:green;font-weight:bold;font-size:16px;">APROBADO</span><br>
								El resultado de su Test es: <span style="color:green;font-weight:bold;">'.$result['corrects'].'</span> Correctas y <span style="color:red;font-weight:bold;">'.$result['incorrects'].'</span> Incorrectas.';
		else:
			$_SESSION['msg'] = '<span style="color:red;font-weight:bold;font-size:16px;">REPROBADO</span><br>
								El resultado de su Test es: <span style="color:green;font-weight:bold;">'.$result['corrects'].'</span> Correctas y <span style="color:red;font-weight:bold;">'.$result['incorrects'].'</span> Incorrectas.';
		endif;

		/*
		Se redirecciona a la pagina del Test nuevamente para mostrar los resultados
		que se mantienen guardados en una variable de sesion
		*/

		header('location:../index.php?p=testdli#resultado');
	}

?>