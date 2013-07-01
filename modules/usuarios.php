<?php 

	/*
	MODELO DE USUARIO

	Este modelo se encarga de procesar todos los datos recibidos del
	controlador de Login y el controlador de Creacion de Usuarios.
	*/

	class users extends db {
		
		/*
		Se crea una propiedad $user para almacenar los datos del 
		usuario que quiere logearse, enviados por el controlador.
		*/

		private $user = array();

		/*
		Metodo Users (metodo constructor)

		Al crearse el objeto USERS ejemplo: $users = new users($arreglo);, 
		se puede pasar por parametros un arreglo con lso datos del usuario 
		a logearse para luego almacenarlos dentro de la propiedad $user
		*/
		
		public function users($data){
			$this->user = $data;
		}

		/*
		Metodo VerifyUser

		Este metodo se encarga de verificar en contra de la base de datos, 
		los datos enviados por el formulario de logeo, es decir lo que esta 
		almacenado en la propiedad $user.

		Una vez obtenidos los datos de la base de datos, el metodo devolvera
		como resultado si existe o no el usuario.
		*/

		public function verifyuser(){
			$sql = "SELECT * FROM usuarios WHERE cedula = '{$this->user['usuario']}' and clave=MD5('{$this->user['password']}');";
			$this->dbConection();
			return $this->getContentASSOC($sql);
		}

		/*
		Metodo CreateUser

		Este metodo se encarga de crear un nuevo usuario a traves del 
		formulario de Registro. Si la insercion en la base de datos tuvo 
		exito, la base de datos devolvera el ID con el que se creo el usuario 
		en la base de datos para verificar que todo funciono correctamente.
		*/

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