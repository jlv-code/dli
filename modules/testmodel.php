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
			
			return $this->createtest($this->getContentASSOC($sql));
		}

		/*
		Metodo CreateTest

		Este metodo se encarga de recibir los datos de la base de datos
		para luego crear el html necesario para la vista
		*/

		public function createtest($test){
			$num = array();
			do {
				$n = rand(0,19);
				if (!in_array($n, $num))
					$num[] = $n;
			} while (count($num)<20);

			$questions = '';
			for($i=0;$i<count($num);$i++){
				if ($test[$num[$i]]['respuesta3']!='n/a') {
					$r3 = '<input type="radio" name="q['.$test[$num[$i]]['id'].']" value="3"><label>'.$test[$num[$i]]['respuesta3'].'</label>';
				} else {
					$r3 = '';
				}
				$questions .= '
					<div class="item">
						<div class="question">
							<p>'.($i+1).'.- '.$test[$num[$i]]['pregunta'].'</p>
						</div>
						<div class="options">
							<input type="radio" name="q['.$test[$num[$i]]['id'].']" value="1"><label>'.$test[$num[$i]]['respuesta1'].'</label>
							<input type="radio" name="q['.$test[$num[$i]]['id'].']" value="2"><label>'.$test[$num[$i]]['respuesta2'].'</label>
							'.$r3.'
						</div>
					</div>
				';
			}
			return $questions;
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
			$questions = array_keys($results['q']);
			$strquestions = implode(',', $questions);
			$results = array_values($results['q']);

			$sql = "select * from test where id in ({$strquestions});";
			require '../config/dbconfig.php';
			$this->dbConection();

			$rights = $this->getContentASSOC($sql);

			$final['corrects']=0;
			$final['incorrects']=0;

			$totalQ = count($rights);

			for($i=0;$i<$totalQ;$i++){
				if ($rights[$i]['correcta']==$results[$i]):
					$final['corrects']+=1;
					$bg = 'lightgreen';
				else:
					$final['incorrects']+=1;
					$bg = '#ff6060';
				endif;

				if ($bg == '#ff6060'):
					$correcta = '<label style="clear:both">
									<p><br>La respuesta correcta es:<br>'.$rights[$i]['respuesta'.$rights[$i]['correcta']].'</p>
									<a href="index.php?p=partescomputador#'.$rights[$i]['localizador'].'">Presione aquí para llevarlo al lugar de la respuesta correcta</a>
								</label>';
				else:
					$correcta = '';
				endif;

				$final['html'] .= '
					<div class="item" style="width:98%;padding:1%;background:'.$bg.';">
						<div class="question">
							<p>'.($i+1).'.- '.$rights[$i]['pregunta'].'</p>
						</div>
						<div class="options">
							<label style="clear:both">'.$rights[$i]['respuesta'.$results[$i]].'</label>
							'.$correcta.'
						</div>
					</div>
				';
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