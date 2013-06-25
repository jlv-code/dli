<?php 

	class users extends db {
		
		private $user = array();
		
		public function users($data){
			$this->user = $data;
		}

		public function verifyuser(){
			$sql = "SELECT * FROM usuarios WHERE cedula = '{$this->user['usuario']}' and clave=MD5('{$this->user['password']}');";
			$this->dbConection();
			return $this->getContentASSOC($sql);
		}

	}

 ?>