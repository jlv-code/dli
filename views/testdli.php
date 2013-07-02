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
		$_SESSION['test'] = $_POST;
		if (isset($_SESSION['test']))
			header('location:controllers/test.php');
	}

	/*
	Si existe algun usuario logeado entonces la vista llama a un controlador llamado TEST.PHP
	*/

	require 'controllers/test.php';

	/*
	Se crea un nuevo TEST, lo que permite obtener de la base de datos las preguntas y posibles 
	respuestas.
	*/

	$test = $newtest;

	/*
	Usando los datos que obtenemos de la base de datos creamos la vista en HTML para mostrar
	el TEST
	*/

	$questions = '';
	for($i=0;$i<count($test);$i++){
		$questions .= '
			<div class="item">
				<div class="question">
					<p>'.$test[$i]['pregunta'].'</p>
				</div>
				<div class="options">
					<input type="radio" name="q['.$i.']" value="1"><label>'.$test[$i]['respuesta1'].'</label>
					<input type="radio" name="q['.$i.']" value="2"><label>'.$test[$i]['respuesta2'].'</label>
					<input type="radio" name="q['.$i.']" value="3"><label>'.$test[$i]['respuesta3'].'</label>
				</div>
			</div>
		';
	}

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