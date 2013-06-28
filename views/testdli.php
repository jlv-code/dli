<?php 

	session_start();
	unset($_SESSION['test']);

	if ($_SESSION['userid']=='')
		header('location:index.php?p=ingresardli');

	if ($_POST){
		$_SESSION['test'] = $_POST;
		if (isset($_SESSION['test']))
			header('location:controllers/test.php');
	}

	require 'controllers/test.php';
	$test = $newtest;

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

<div class="wrap-test">
	<p style="color:#a00;font-weight:bold;"><?php 
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

				print $_SESSION['msg'];
				unset($_SESSION['msg']);

			?></p>
		</div>
	</form>
</div>