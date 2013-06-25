<?php

	class db {

		private $conection;
		private $param = array();

		public function dbConection(){
			require '../config/dbconfig.php';
			$stringcon = "host=".$db['db_serv']." dbname=".$db['db_name']." user=".$db['db_user']." password=".$db['db_pass'];
	    	$this->conection = pg_pconnect($stringcon) or die ("No hay Conexión con el Servidor!");
		}

		public function dbCloseConection() {
			pg_close($this->conection);
		}
		
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
