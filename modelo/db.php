<?php class DB{

	//const HOST="localhost";
	//const DB="PROYECTO_DB";
	const USER="root";
	const PASS="";
	const HOST_DB='mysql:host=localhost;dbname=PROYECTO_TEST';

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

		$resultado=$conexion->prepare(QR::CONSULTA_PROYECTO_TODOS);
		$resultado->execute();

		if($resultado->rowCount()>0){
			while($atributos=$resultado->fetch(PDO::FETCH_ASSOC)){
				$arrayProyectos[]=new Proyecto($atributos);
			}
		}

		self::desconectar($conexion);
		return $arrayProyectos;
	}


	public static function getUserProyectos($id_proyecto){
		$conexion;
		$arrayUsersProyectos=NULL;
		self::conectar($conexion);

		$resultado=$conexion->prepare(QR::CONSULTA_USER_PROYECTO);
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

		$resultado=$conexion->prepare(QR::CONSULTA_DATOS_USUARIO);
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

		$resultado=$conexion->prepare(QR::CONSULTA_USUARIO_EXISTE);
		$resultado->bindParam(1,$user);
		$resultado->execute();

			if($resultado->rowCount()>0){
				//ErrorHandler::$arrayError[]="* El nombre de usuario especificado ya está en uso";
				return false;
			}

		return true;		
}

	private static function nuevoUsuario($objetoRegistro,$conexion){
		$resultado2=$conexion->prepare(QR::INSERTAR_USUARIO);
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

		$resultado=$conexion->prepare(QR::CONTAR_USUARIOS);
		$resultado->execute();

		$numero=$resultado->fetch(PDO::FETCH_ASSOC);

		self::desconectar($conexion);
		return $numero;
	}


//LOGIN
	public static function verificarUsuario($user,$pass,&$obj){
		$conexion;
		self::conectar($conexion);

		$resultado=$conexion->prepare(QR::CONSULTA_USUARIO);
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

		$resultado=$conexion->prepare(QR::CONSULTA_USUARIO);
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

		$resultado=$conexion->prepare(QR::CONSULTA_SESSION_PROYECTO);
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

		$resultado=$conexion->prepare(QR::CONSULTA_DATOS_PROYECTO);
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

		$resultado=$conexion->prepare(QR::CONSULTA_VIEW_SESSION_PROYECTO);
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

	$resultado=$conexion->prepare(QR::CONSULTA_FASES);
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

		$resultado=$conexion->prepare(QR::CONSULTA_TAREAS);
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

	$resultado=$conexion->prepare(QR::CONTAR_PROYECTOS);
	$resultado->execute();

	$numero=$resultado->fetch(PDO::FETCH_ASSOC);

	self::desconectar($conexion);
	return $numero;
}
	
		public static function insertarProyecto($atributos){
			$conexion;
			self::conectar($conexion);

			$conexion->beginTransaction();


		try{

				$resultado=$conexion->prepare(QR::INSERTAR_PROYECTO);
				$resultado->bindParam(1,$atributos["id"]);
				$resultado->bindParam(2,$atributos["title"]);
				$resultado->bindParam(3,$atributos["descripcion"]);
				$resultado->bindParam(4,$atributos["fLimit"]);
				$resultado->execute();

			if($resultado->rowCount()==1){

				$todoBien=true;

//OBSOLETO: La fase default se inserta por trigger
/*
				if($collabFlag&&self::insertarUserProyecto($conexion,$atributos["id"],0)&&self::insertarFase($conexion,$atributos)){
*/
			
				$todoBien=self::insertarUserProyecto($conexion,$atributos["id"],0);

			//Controlar si se ha insertado usuario colaborador
				
				if(isset($atributos["id_collab"])){
					foreach ($atributos["id_collab"] as $key => $value) {
						$todoBien=self::insertarUserProyecto($conexion,$atributos["id"],1,$value);
					}
						//$collabFlag=self::insertarUserProyecto($conexion,$atributos["id"],1,$atributos["id_collab"]);
				}

				if($todoBien){
					$conexion->commit();
					self::desconectar($conexion);
					return true;
				}else{
					throw new PDOException("Algo ha fallado");
				}

			}


			}catch(PDOException $e){
				//SQLSTATE[HY00] no se puede actualizar
				$msjError=$e->getMessage();
				echo $msjError;
				//controlar excepciones
			}

			$conexion->rollback();

			self::desconectar($conexion);
			return false;
		}

		public static function insertarUserProyecto(&$conexion,$id_proyecto,$id_rango,$id_user=NULL){
			$resultado2=$conexion->prepare(QR::INSERTAR_USER_PROYECTO);
			$resultado2->bindParam(1,$id_proyecto);
			if($id_user==NULL){
				$id_user=$_SESSION["user"];
			}
			$resultado2->bindParam(2,$id_user);
			$resultado2->bindParam(3,$id_rango);
			$resultado2->execute();

				if($resultado2->rowCount()==1){
					return true;
				}
			return false;
		}


			public static function consultarUsuariosEx($idUser){
				$listaUsers=NULL;
				$conexion;
				self::conectar($conexion);

				//$conexion->beginTransaction();

				$resultado=$conexion->prepare(QR::ALL_USERS_EXCALLER);
					$resultado->bindParam(1,$idUser);
					$resultado->execute();

					if($resultado->rowCount()>0){
						while($atributos=$resultado->fetch(PDO::FETCH_ASSOC)){
							$listaUsers[]=new User($atributos);
						}
					}

				//$conexion->rollback();

				self::desconectar($conexion);
				return $listaUsers;
			}

//LA FASE DEFAULT FA00000 ES AUTOMÁTICA
//RENOVAR PARA FASES PERSONALIZADAS
		public static function insertarFase(&$conexion,$atributos){
			$resultado2=$conexion->prepare(QR::INSERTAR_FASE);
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

	$resultado=$conexion->prepare(QR::CONTAR_TAREAS);
	$resultado->bindParam(1,$id_proyecto);
	$resultado->execute();

	$numero=$resultado->fetch(PDO::FETCH_ASSOC);

	self::desconectar($conexion);
	return $numero;
}

public static function contarFases($id_proyecto){
	$conexion;
	self::conectar($conexion);

	$resultado=$conexion->prepare(QR::CONTAR_FASES);
	$resultado->bindParam(1,$id_proyecto);
	$resultado->execute();

	$numero=$resultado->fetch(PDO::FETCH_ASSOC);

	self::desconectar($conexion);
	return $numero;
}


		public static function insertarTarea($atributos){
			$conexion;
			self::conectar($conexion);

				$resultado=$conexion->prepare(QR::INSERTAR_TAREA);
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


//MÉTODOS BORRAR
		public static function eliminarProyecto($id){
			$conexion;
			self::conectar($conexion);

				if(self::eliminarFase($conexion,$id,null)){

						$resultado=$conexion->prepare(QR::DEL_PROYECTO);
						$resultado->bindParam(1,$id);
						$resultado->execute();

						if($resultado->rowCount()==1){
							//datos relacionados: comments, metadata
							self::eliminarUserProyecto(null,$id,null);
							self::desconectar($conexion);
							return true;
						}
				}

			self::desconectar($conexion);
			return false;
		}



private static function eliminarFase($conexion,$id_proyecto,$id=null){
				if($id==null){
					//no controlamos si encuentra más de cero porque puede no tener tareas la fase
						self::eliminarTareas($conexion,$id_proyecto,null,null);

						$resultado=$conexion->prepare(QR::DEL_TODAS_FASE);
						$resultado->bindParam(1,$id_proyecto);
						$resultado->execute();

						if($resultado->rowCount()>0){
							//datos relacionados: comments, metadata
							return true;
						}

				}else{
						self::eliminarTareas($conexion,$id_proyecto,$id,null);

						$resultado=$conexion->prepare(QR::DEL_FASE);
						$resultado->bindParam(1,$id_proyecto);
						$resultado->bindParam(2,$id);
						$resultado->execute();

						if($resultado->rowCount()>0){
							//datos relacionados: comments, metadata
							return true;
						}
				}

			return false;
		}

	//de debería poder eliminar una tarea sin eliminar nada más
	// crear variable conexion dentro 
private static function eliminarTareas($conexion,$id_proyecto,$id_fase=null,$id=null){
			if($id_fase==null){
						$resultado=$conexion->prepare(QR::DEL_PROYECTO_TAREA);
						$resultado->bindParam(1,$id_proyecto);
						$resultado->execute();

						if($resultado->rowCount()>0){
							//datos relacionados: comments, metadata
							return true;
						}

			}else if($id==null){
						$resultado=$conexion->prepare(QR::DEL_FASE_TAREA);
						$resultado->bindParam(1,$id_proyecto);
						$resultado->bindParam(2,$id_fase);
						$resultado->execute();

						if($resultado->rowCount()>0){
							//datos relacionados: comments, metadata
							return true;
						}

			}else{
						$resultado=$conexion->prepare(QR::DEL_TAREA);
						$resultado->bindParam(1,$id_proyecto);
						$resultado->bindParam(2,$id_fase);
						$resultado->bindParam(3,$id);
						$resultado->execute();

						if($resultado->rowCount()>0){
							//datos relacionados: comments, metadata
							return true;
						}
			}
			return false;
}

public static function eliminarUserProyecto($conexion=null,$id_proyecto,$id_user=null){

		$nuevaConexion=null;
			if($conexion==null){
				self::conectar($nuevaConexion);
				$conexion=$nuevaConexion;
			}

				if($id_user==null){
						$resultado=$conexion->prepare(QR::DEL_TODO_USER_PROYECTO);
						$resultado->bindParam(1,$id_proyecto);
						$resultado->execute();

						if($resultado->rowCount()>0){
							if($nuevaConexion!=null)self::desconectar($conexion);
							return true;
						}
				}else{
						$resultado=$conexion->prepare(QR::DEL_USER_PROYECTO);
						$resultado->bindParam(1,$id_proyecto);
						$resultado->bindParam(2,$id_user);
						$resultado->execute();

						if($resultado->rowCount()>0){
							if($nuevaConexion!=null)self::desconectar($conexion);
							return true;
						}
				}
		if($nuevaConexion!=null)self::desconectar($conexion);
		return false;
}

}
?>