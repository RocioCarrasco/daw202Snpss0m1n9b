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

	//Contar proyectos
		const CONTAR_PROYECTOS="SELECT COUNT(ID) from proyecto";
	//Datos user-session/proyecto
		const CONSULTA_SESSION_PROYECTO="SELECT * FROM USER_PROYECTO WHERE id_user=?";
		//Contar proyectos en los que el usuario es admin
		const CONTAR_SESSION_PROYECTOS="SELECT COUNT(id_proyecto) FROM user_proyecto where id_user=? and id_rango=?";
		//Todos los datos user-session/proyecto
			const CONSULTA_VIEW_SESSION_PROYECTO="SELECT * FROM user_proyecto_view WHERE id_proyecto=? ORDER BY id_rango";

	//Fases de un proyecto
		const CONSULTA_FASES="SELECT * FROM FASE WHERE proyecto=?";
		//Contar fases
			const CONTAR_FASES="SELECT COUNT(ID) FROM FASE WHERE proyecto=?";
		//Tareas de un proyecto
			const CONSULTA_TAREAS="SELECT * FROM TAREA WHERE id_proyecto=? AND id_status=? ORDER BY fase AND id_status";
		//Contar tareas
			const CONTAR_TAREAS="SELECT COUNT(ID) FROM TAREA WHERE id_proyecto=?";

	//Verificar usuario: antes de login
		const CONSULTA_USUARIO="SELECT * FROM USER WHERE nick=? AND pass=?";

	//Comprobar si existe usuario: antes del registro
		const CONSULTA_USUARIO_EXISTE="SELECT * FROM USER WHERE nick=?";
	//Insertar usuario: registro
		const INSERTAR_USUARIO="INSERT INTO `USER`(`id`, `nick`, `email`, `pass`) VALUES (?,?,?,?)";
	//Contar usuarios: necesario para crear id_registro
		const CONTAR_USUARIOS="SELECT COUNT(id) FROM USER"; 

//INSERTAR DATOS
		//Nuevo proyecto
		const INSERTAR_PROYECTO="INSERT INTO PROYECTO (id,title,descripcion) VALUES (?,?,?)";
				const INSERTAR_USER_PROYECTO="INSERT INTO USER_PROYECTO (id_proyecto,id_user,id_rango) VALUES (?,?,?)";
					const INSERTAR_FASE="INSERT INTO FASE(proyecto, id, title, descripcion) VALUES (?,?,?,?)";
		//Nueva tarea
		const INSERTAR_TAREA="INSERT INTO TAREA (fase,id_proyecto,id,id_status,title,descripcion) VALUES (?,?,?,?,?,?)";

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


//CARGAR PROYECTOS DEL USUARIO/SESIÓN
	
public static function getSessionProyectos(){
		$conexion;
		$arrayUsersProyectos=NULL;
		self::conectar($conexion);

		$resultado=$conexion->prepare(self::CONSULTA_SESSION_PROYECTO);
		$resultado->bindParam(1,$_SESSION["user"]);
		$resultado->execute();

		if($resultado->rowCount()>0){
			while($campos=$resultado->fetch(PDO::FETCH_ASSOC)){
				$arrayUsersProyectos[]=$campos;
			}
		}
		self::desconectar($conexion);
		return $arrayUsersProyectos;
	}

public static function getDatosProyecto($id){
		$conexion;
		self::conectar($conexion);
		$proyecto=NULL;

		$resultado=$conexion->prepare(self::CONSULTA_DATOS_PROYECTO);
		$resultado->bindParam(1,$id);
		$resultado->execute();

		if($resultado->rowCount()==1){
			print "ECHO";
			$atributos=$resultado->fetch(PDO::FETCH_ASSOC);
			$proyecto=new Proyecto($atributos);	
		}

		self::desconectar($conexion);
		return $proyecto;
	}


public static function getViewUserProyecto($id){
		$conexion;
		self::conectar($conexion);
		$proyecto=NULL;

		$resultado=$conexion->prepare(self::CONSULTA_VIEW_SESSION_PROYECTO);
		$resultado->bindParam(1,$id);
		$resultado->execute();

		for($i=0;$i<$resultado->rowCount();$i++){
			$row=$resultado->fetch(PDO::FETCH_ASSOC);
			$proyecto[]=$row;	
		}

		self::desconectar($conexion);
		return $proyecto;
	}

//VISTA_PROYECTO
public static function getFases($id_proyecto){
	$fase=NULL;
	$conexion;
	self::conectar($conexion);

	$resultado=$conexion->prepare(self::CONSULTA_FASES);
	$resultado->bindParam(1,$id_proyecto);
	$resultado->execute();

	if($resultado->rowCount()>0){
		while($atributos=$resultado->fetch(PDO::FETCH_ASSOC)){
			$fase[]=new Fase($atributos);
		}
	}

	self::desconectar($conexion);
	return $fase;
}

public static function getTareas($id_proyecto,$status){
	$tarea=NULL;
	$conexion;
	self::conectar($conexion);

		$resultado=$conexion->prepare(self::CONSULTA_TAREAS);
		$resultado->bindParam(1,$id_proyecto);
		$resultado->bindParam(2,$status);
		$resultado->execute();

	if($resultado->rowCount()>0){
		while($atributos=$resultado->fetch(PDO::FETCH_ASSOC)){
			$tarea[$atributos['fase']][]=new Tarea($atributos);
		}
	}

	self::desconectar($conexion);
	return $tarea;
}

//CREAR PROYECTOS Y TAREAS

public static function contarProyectos(){
	$conexion;
	self::conectar($conexion);

	$resultado=$conexion->prepare(self::CONTAR_PROYECTOS);
	$resultado->execute();

	$numero=$resultado->fetch(PDO::FETCH_ASSOC);

	self::desconectar($conexion);
	return $numero;
}
	
		public static function insertarProyecto($atributos){
			$conexion;
			self::conectar($conexion);

			$conexion->beginTransaction();

				$resultado=$conexion->prepare(self::INSERTAR_PROYECTO);
				$resultado->bindParam(1,$atributos["id"]);
				$resultado->bindParam(2,$atributos["title"]);
				$resultado->bindParam(3,$atributos["descripcion"]);
				$resultado->execute();

			if($resultado->rowCount()==1){
				if(self::insertarUserProyecto($conexion,$atributos["id"],0)&&self::insertarFase($conexion,$atributos)){
					$conexion->commit();
					self::desconectar($conexion);
					return true;
				}
			}

			$conexion->rollback();

			self::desconectar($conexion);
			return false;
		}

		public static function insertarUserProyecto(&$conexion,$id_proyecto,$id_rango){
			$resultado2=$conexion->prepare(self::INSERTAR_USER_PROYECTO);
			$resultado2->bindParam(1,$id_proyecto);
			$resultado2->bindParam(2,$_SESSION["user"]);
			$resultado2->bindParam(3,$id_rango);
			$resultado2->execute();

				if($resultado2->rowCount()==1){
					return true;
				}
			return false;
		}

		public static function insertarFase(&$conexion,$atributos){
			$resultado2=$conexion->prepare(self::INSERTAR_FASE);
			$resultado2->bindParam(1,$atributos["proyecto_fase"]);
			$resultado2->bindParam(2,$atributos["id_fase"]);
			$resultado2->bindParam(3,$atributos["title_fase"]);
			$resultado2->bindParam(4,$atributos["desc_fase"]);
			$resultado2->execute();

				if($resultado2->rowCount()==1){
					return true;
				}
			return false;
		}

public static function contarTareas($id_proyecto){
	$conexion;
	self::conectar($conexion);

	$resultado=$conexion->prepare(self::CONTAR_TAREAS);
	$resultado->bindParam(1,$id_proyecto);
	$resultado->execute();

	$numero=$resultado->fetch(PDO::FETCH_ASSOC);

	self::desconectar($conexion);
	return $numero;
}

public static function contarFases($id_proyecto){
	$conexion;
	self::conectar($conexion);

	$resultado=$conexion->prepare(self::CONTAR_FASES);
	$resultado->bindParam(1,$id_proyecto);
	$resultado->execute();

	$numero=$resultado->fetch(PDO::FETCH_ASSOC);

	self::desconectar($conexion);
	return $numero;
}


		public static function insertarTarea($atributos){
			$conexion;
			self::conectar($conexion);

				$resultado=$conexion->prepare(self::INSERTAR_TAREA);
				$resultado->bindParam(1,$atributos["fase"]);
				$resultado->bindParam(2,$atributos["id_proyecto"]);
				$resultado->bindParam(3,$atributos["id"]);
				$resultado->bindParam(4,$atributos["id_status"]);
				$resultado->bindParam(5,$atributos["title"]);
				$resultado->bindParam(6,$atributos["descripcion"]);
				$resultado->execute();

			if($resultado->rowCount()==1){
					self::desconectar($conexion);
					return true;
			}

			self::desconectar($conexion);
			return false;
		}


}
?>