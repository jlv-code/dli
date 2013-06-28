<?php 

	session_start();

	if ($_SESSION['userid']=='')
		header('location:index.php?p=ingresardli');

	if (!isset($_SESSION['test'])){
		require 'modules/bd.php';
		require 'modules/testmodel.php';

		$db = new db();
		$test = new test();

		$newtest = $test->maketest();
	} 

	if (isset($_SESSION['test'])){
		require '../modules/bd.php';
		require '../modules/testmodel.php';

		$db = new db();
		$test = new test();

		$result = $test->verifytest($_SESSION['test']);

		if ($result['result']):
			$_SESSION['msg'] = '<span style="color:green;font-weight:bold;font-size:16px;">APROBADO</span><br>
								El resultado de su Test es: <span style="color:green;font-weight:bold;">'.$result['corrects'].'</span> Correctas y <span style="color:red;font-weight:bold;">'.$result['incorrects'].'</span> Incorrectas.';
		else:
			$_SESSION['msg'] = '<span style="color:red;font-weight:bold;font-size:16px;">REPROBADO</span><br>
								El resultado de su Test es: <span style="color:green;font-weight:bold;">'.$result['corrects'].'</span> Correctas y <span style="color:red;font-weight:bold;">'.$result['incorrects'].'</span> Incorrectas.';
		endif;

		header('location:../index.php?p=testdli#resultado');
	}

?>