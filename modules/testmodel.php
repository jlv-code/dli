<?php

	class test extends db {
		
		public function maketest(){
			$sql = "select * from test;";
			require 'config/dbconfig.php';
			$this->dbConection($db);
			
			return $this->getContentASSOC($sql);
		}

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