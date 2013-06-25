<?php 

	if ($_SESSION['userid']!=''):
		print 'Usuario: '.$_SESSION['userid'];
	else:
		header('location:index.php?p=ingresardli');
	endif;

?>