<?php 

	/*
	VISTA DEL TEST

	Esta vista se llama exclusivamente si existe un usuario logeado dentro del sistema.

	Se verifica la session del usuario para evitar que entre directamente por URL a esta vista.
	*/

	session_start();

	/*
	Se elimina todo el contenido dentro de la variable SESSION['test'] para asegurar que no se embasure 
	para el siguiente procedimiento.
	*/
	unset($_SESSION['test']);

	/*
	Verificacion de usuario logeado
	*/

	if ($_SESSION['userid']=='')
		header('location:index.php?p=ingresardli');

	if ($_POST){
		if (count($_POST['q'])<20):
			$_SESSION['msg_err'] = 'Debe completar todas las preguntas para poder ser evaluado.';
		else:
			$_SESSION['test'] = $_POST;
			if (isset($_SESSION['test']))
				header('location:controllers/test.php');
		endif;
	} 
	/*
	Si existe algun usuario logeado entonces la vista llama a un controlador llamado TEST.PHP
	*/

	require 'controllers/test.php';

	/*
	Se crea un nuevo TEST, lo que permite obtener de la base de datos las preguntas y posibles 
	respuestas incluyendo el html para dicha vista.
	*/
	if ($_SESSION['html']!=''):
		$questions = $_SESSION['html'];
		unset($_SESSION['html']);
	else:
		$questions = $newtest;
	endif;	

?>
<!--
Aqui imprimimos toda la vista del TEST
-->
<div class="wrap-test">
	<p style="color:#a00;font-weight:bold;"><?php 

			/*
			Se verifica si existe algun mensaje de error generado por el controlador
			*/

			print ($msg_err)?$msg_err:$_SESSION['msg_err'];
			unset($_SESSION['msg_err']);

		?></p>
	<form id="test-form" name="test-form" method="post">
		<?php print $questions; ?>
		<div class="buttons">
			<input type="submit" value="Enviar resultados">
		</div>
		<div id="resultado">
			<p><?php 

				/*
				Aqui se muestra los resultados del TEST
				*/

				print $_SESSION['msg'];
				unset($_SESSION['msg']);

			?></p>
		</div>
	</form>
</div>