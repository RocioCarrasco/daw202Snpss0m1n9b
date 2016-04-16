<?php class DB{

	//const HOST="localhost";
	//const DB="PROYECTO_DB";
	const USER="root";
	const PASS="";
	const HOST_DB='mysql:host=localhost;dbname=PROYECTO_TEST';

		const CONSULTA_DATOS_USUARIO="SELECT * FROM USER WHERE id=?";
		const CONSULTA_DATOS_PROYECTO="SELECT * FROM PROYECTO WHERE id=?";
		const CONSULTA_DATOS_FASE="SELECT * FROM FASE WHERE id=?";
		const CONSULTA_DATOS_TAREA="SELECT * FROM TAREA WHERE id=?";

		const CONSULTA_PROYECTO_TODOS="SELECT * FROM PROYECTO";
		const CONSULTA_USER_PROYECTO="SELECT * FROM USER_PROYECTO WHERE id_proyecto=?";

	//Verificar usuario: antes de login
		const CONSULTA_USUARIO="SELECT * FROM USER WHERE nick=? AND pass=?";

	//Comprobar si existe usuario: antes del registro
		const CONSULTA_USUARIO_EXISTE="SELECT * FROM USER WHERE nick=?";
	//Insertar usuario: registro
		const INSERTAR_USUARIO="INSERT INTO `USER`(`id`, `nick`, `email`, `pass`) VALUES (?,?,?,?)";
	//Contar usuarios: necesario para crear id_registro
		const CONTAR_USUARIOS="SELECT COUNT(id) FROM USER"; 


	private static function conectar(&$conexion){
		
			$conexion=new PDO(self::HOST_DB,self::USER,self::PASS);
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
	}

	private static function desconectar(&$conexion){
		unset($conexion);
	}
	



	public static function getProyectos(){
		$conexion;
		$arrayProyectos=NULL;
		self::conectar($conexion);

		$resultado=$conexion->prepare(self::CONSULTA_PROYECTO_TODOS);
		$resultado->execute();

		if($resultado->rowCount()>0){
			while($atributos=$resultado->fetch(PDO::FETCH_ASSOC)){
				$arrayProyectos[]=new Proyecto($atributos);
/*
				$arrayFutbolistas[]=new Futbolista(
							$atributos["dni"],
							$atributos["nombre"],
							$atributos["sueldo"],
							$atributos["dorsal"],
							$atributos["goles"],
							$atributos["peso"],
							$atributos["altura"]); 
*/
			}
		}

		self::desconectar($conexion);

		//print "<pre>";
		//print_r($arrayProyectos);
		//print "</pre>";
		return $arrayProyectos;
	}


	public static function getUserProyectos($id_proyecto){
		$conexion;
		$arrayUsersProyectos=NULL;
		self::conectar($conexion);

		$resultado=$conexion->prepare(self::CONSULTA_USER_PROYECTO);
		$resultado->bindParam(1,$id_proyecto);
		$resultado->execute();

		if($resultado->rowCount()>0){
			while($campos=$resultado->fetch(PDO::FETCH_ASSOC)){
				$arrayUsersProyectos[]=$campos;
			}
		}
		self::desconectar($conexion);
		return $arrayUsersProyectos;
	}

	public static function getUser($id){
		$conexion;
		$user=NULL;
		self::conectar($conexion);

		$resultado=$conexion->prepare(self::CONSULTA_DATOS_USUARIO);
		$resultado->bindParam(1,$id);
		$resultado->execute();

		if($resultado->rowCount()>0){
			while($atributos=$resultado->fetch(PDO::FETCH_ASSOC)){
				$user=new User($atributos);
			}
		}

		self::desconectar($conexion);
		return $user;
	}

//IMPORT
//TODO: recauchutar


//REGISTRO
	public static function registroUsuario($objetoRegistro){
		//if(!self::camposCompletados($user,$pass,$repass))return false;
		//if(!self::checkPass($pass,$repass))return false;
		
		$conexion;
		self::conectar($conexion);
		
		if(!self::noExisteUsuario($objetoRegistro->nick,$conexion)){
			self::desconectar($conexion);
			return false;
		}
		
		if(!self::nuevoUsuario($objetoRegistro,$conexion)){
			self::desconectar($conexion);
			return false;
		}

		self::desconectar($conexion);
		return true;
	}
/*
	private static function camposCompletados($user,$pass,$repass){
		if(empty($user)||empty($pass)||empty($repass)){
			ErrorHandler::$arrayError[]="* Debe completar todos los campos";
			return false;
		}
		return true;
	}
*/

/*
	private static function checkPass($pass,$repass){
		if($pass<>$repass){
			ErrorHandler::$arrayError[]="* La contraseña debe ser igual en los dos campos";
			return false;
		}
		return true;
	}
*/

	private static function noExisteUsuario($user,$conexion){

		$resultado=$conexion->prepare(self::CONSULTA_USUARIO_EXISTE);
		$resultado->bindParam(1,$user);
		$resultado->execute();

			if($resultado->rowCount()>0){
				//ErrorHandler::$arrayError[]="* El nombre de usuario especificado ya está en uso";
				return false;
			}

		return true;		
}

	private static function nuevoUsuario($objetoRegistro,$conexion){
		$resultado2=$conexion->prepare(self::INSERTAR_USUARIO);
		$resultado2->bindParam(1,$objetoRegistro->id);
		$resultado2->bindParam(2,$objetoRegistro->nick);
		$resultado2->bindParam(3,$objetoRegistro->email);
		$resultado2->bindParam(4,$objetoRegistro->pass);
		$resultado2->execute();


			if($resultado2->rowCount()>0){
				return true;
			}
			//ErrorHandler::$arrayError[]="* No se ha podido insertar al usuario";
			return false;
	}

	public static function contarUsuarios(){
		$conexion;
		self::conectar($conexion);

		$resultado=$conexion->prepare(self::CONTAR_USUARIOS);
		$resultado->execute();

		$numero=$resultado->fetch(PDO::FETCH_ASSOC);

		self::desconectar($conexion);
		return $numero;
	}


//LOGIN
	public static function verificarUsuario($user,$pass,&$obj){
		$conexion;
		self::conectar($conexion);

		$resultado=$conexion->prepare(self::CONSULTA_USUARIO);
		$resultado->bindParam(1,$user);
		$resultado->bindParam(2,$pass);
		$resultado->execute();

			if($resultado->rowCount()==1){
				//print "mi";

				$atributos=$resultado->fetch(PDO::FETCH_ASSOC);
				$obj=new User($atributos);	

				self::desconectar($conexion);
				return true;
			}

		self::desconectar($conexion);
		//ErrorHandler::$arrayError[]="* Usuario no encontrado";
		return false;
	}

	public static function RecuperarUsuario($user,$pass){
		$conexion;
		self::conectar($conexion);
		
		$user=NULL;

		$resultado=$conexion->prepare(self::CONSULTA_USUARIO);
		$resultado->bindParam(1,$user);
		$resultado->bindParam(2,$pass);
		$resultado->execute();

			if($resultado->rowCount()==1){
				$atributos=$resultado->fetch(PDO::FETCH_ASSOC);
				$user=new User($atributos);	
			}

		self::desconectar($conexion);
		//ErrorHandler::$arrayError[]="* Usuario no encontrado";
		return $user;
	}
}
?>