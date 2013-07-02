<?php

	/*
	MODELO DE BASE DE DATOS

	Este modelo se encarga de de gestionar la entrada y salida de datos 
	en la base de datos
	*/

	class db {

		/*
		Propiedad $conection
		Se encarga de obtener los datos de la conexcion a la BD
		*/

		private $conection;

		/*
		Metodo dbConection

		Este metodo establece la conexion a la base de datos usando un 
		arreglo que contiene los datos del servidor
		*/

		public function dbConection($db=''){
			if (!is_array($db))
				require '../config/dbconfig.php';

			$stringcon = "host=".$db['db_serv']." dbname=".$db['db_name']." user=".$db['db_user']." password=".$db['db_pass'];
	    	$this->conection = pg_pconnect($stringcon) or die ("No hay Conexión con el Servidor!");
		}

		/*
		Metodo dbCloseConection

		Este metodo cierra la conexcion a la base de datos.
		*/

		public function dbCloseConection() {
			pg_close($this->conection);
		}

		/*
		Metodo getContentASSOC

		Este metodo se encarga de obtener un arreglo asociativo para 
		manipular los datos que provienen de la BD.

		Adicionalmente se usa para ingresar y actualizar datos a la BD.
		*/
		
		public function getContentASSOC($sql) {
			$result = @pg_query($this->conection,$sql);
			$rows = pg_num_rows($result);
			if ($result):
				for ($j=0;$j<$rows;$j++):
					$arrResult[] = @pg_fetch_assoc($result,$j);
				endfor;
			endif;
			return $arrResult;
		}
		
	}
?>
