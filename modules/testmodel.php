<?php

	/*
	MODELO TEST

	Este modelo se encarga de procesar los datos enviados por el controlador TEST
	*/

	class test extends db {

		/*
		Metodo MakeTest

		Se encarga de devolver las preguntas y posibles respuestas 
		que estan en base de datos.
		Se hace un query de busqueda, luego se realiza una conexion con la BD
		y por ultimo se retorna lo que devuelve la ejecucion de la consulda.
		*/
		
		public function maketest(){
			$sql = "select * from test;";
			require 'config/dbconfig.php';
			$this->dbConection($db);
			
			return $this->getContentASSOC($sql);
		}

		/*
		Metodo VerifyTest

		Este metodo se encarga de realizar una verificacion del Test 
		realizado por el usuario, para emitir un resultado final.

		Se buscan todas las respuestas correctas en base de datos
		de las preguntas mostradas en el Test, luego por medio de un ciclo,
		se van verificando una a una las respuestas y se evaluan si son o no 
		correctas, luego se van almacenando en una variable que sera devuelta
		por la funcion.
		*/

		public function verifytest($results){
			$sql = "select correcta from test;";
			require '../config/dbconfig.php';
			$this->dbConection();

			$rights = $this->getContentASSOC($sql);

			$final['corrects']=0;
			$final['incorrects']=0;

			$totalQ = count($rights);

			for($i=0;$i<$totalQ;$i++){
				if ($rights[$i]['correcta']==$results['q'][$i]):
					$final['corrects']+=1;
				else:
					$final['incorrects']+=1;
				endif;
			}

			if (ceil($totalQ/2)<=$final['corrects']):
				$final['result'] = true;
			else:
				$final['result'] = false;
			endif;

			return $final;
		}
	}

?>