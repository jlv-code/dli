<?php 

	session_start();

	if ($_GET['p'])
		$p = strip_tags($_GET['p']);

	if ($_SESSION['userid']):
		$href = '?p=cerrarsesion';
		$link = 'Cerrar Sesión';
		$description = 'Usuario: '.$_SESSION['userid'];
	else:
		$href = '?p=ingresardli';
		$link = 'Ingresar a DLI';
		$description = 'Registro o Inicio de Sesión';
	endif;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<title>Disfrutando la Informática</title>
</head>
<body>
	<div id="wrap">
		<header>
			<div class="imgheader"><img src="img/header.png"></div>
			<nav>
				<ul class="menu">
					<li><a href="?p=partescomputador">Partes del Computador<span>Conceptos e Imagenes</span></a></li>
					<li><a href="?p=galeriadli">Galería DLI<span>Varidad de  Imágenes</span></a></li>
					<li><a href="?p=instrucciones">Instrucciones<span>Del Test</span></a></li>
					<li><a href="?p=testdli">Test DLI<span>Test de Prueba</span></a></li>
					<li><a href="?p=creditos">Créditos<span>Desarrolladores</span></a></li>
					<li><a href="<?php print $href; ?>"><?php print $link; ?><span><?php print $description; ?></span></a></li>
				</ul>
			</nav>
		</header>
		<div id="content">
			<?php include 'views/'.$p.'.php' ?>
		</div>
		<!--<footer>
			<h3>DLI 2013 - Todos los derechos reservados.</h3>
		</footer>-->
	</div>
</body>
</html>