<?php 

	/*
	Iniciamos Sesion de PHP
	*/

	session_start();

	/*
	El $_GET['p'] nos dira que VISTA debe cargarse. En la URL de la barra de direcciones,
	aparece un link como: http://localhost/dli/index.php?p=testdli
	Esto hara que el PHP busque la Vista "testdli" y la imprima en este codigo
	*/

	if ($_GET['p'])
		$p = strip_tags($_GET['p']);

	/*
	Aqui verificamos la variable de SESSION['userid'] para saber si existe o no un usuario
	logeado dentro del sistema. Este codigo verifica todo el sistema.
	En caso que el usuario este logeado, se cambia el boton del menu de INGRESAR A DLI por
	un boton llamado CERRAR SESION.
	Si el usuario no esta logeado NO puedo ingresar al TEST y lo envia directamente a la
	pagina de INGRESAR A DLI.
	*/

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
					<!--
					Aqui es donde se imprime el boton de INGRESAR A DLI o el boton CERRAR SESION si el usuario esta logeado o no.
					-->
					<li><a href="<?php print $href; ?>"><?php print $link; ?><span><?php print $description; ?></span></a></li>
				</ul>
			</nav>
		</header>
		<div id="content">
			<!-- 
			Una vez que se obtiene de $_GET['p'] la vista, esta codigo de abajo se encarga de imprimir el codigo que esta en la vista
			-->
			<?php include 'views/'.$p.'.php' ?>
		</div>
		<!--<footer>
			<h3>DLI 2013 - Todos los derechos reservados.</h3>
		</footer>-->
	</div>
</body>
</html>