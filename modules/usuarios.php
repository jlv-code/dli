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

		public function createuser(){
			$ins = "INSERT INTO usuarios (
					cedula,
					apellidos,
					nombres,
					clave) VALUES (
					'{$this->user['cedula']}',
					'{$this->user['apellidos']}',
					'{$this->user['nombres']}',
					MD5('{$this->user['clave']}'))returning cedula;";
			$this->dbConection();
			return $this->getContentASSOC($ins);
		}

	}

 ?>