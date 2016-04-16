<?php 
	//variables
		//$arrayProyectos=NULL;
		//$arrayFases=NULL;
		//$arrayTareas=NULL;

		//$linkSessionProyecto=NULL;
?>

<?php class Controller{

	//private static $requestCatcher;
	//private static $dataCollector;
	//private static $requestCatcher;

	public static $arrDatos=array("PRO"=>array(),"FAS"=>array(),"TAR"=>array(),"LSP"=>array());

	//public function __construct(){
	// 	$requestCatcher=new RequestCatcher();
	// 	$dataCollector=new DataCollector();
	// 	$RequestThrower=new RequestThrower();
	// }


//
//FUNCIONES DE CONTROL DE SESIÓN Y PÁGINA

public static function is_session_on(){
	if(isset($_SESSION['user']))return true;
	return false;
}

public static function session_init($obj){
		$_SESSION['user']=$obj->id;	
		$_SESSION['nick']=$obj->nick;
}

//petición de VISTAS
public static function vista_request(){
	if(self::is_session_on()){
			
			if(self::is_proyect_request()){
//Si ha desaparecido de la base de datos no lo verifica
//if(anybodyThere($_SESSION["proyecto"])){}
				self::getDatosProyecto($_SESSION["proyecto"]);
				require_once("vista_proyecto_N.php");

			}else{

			self::$arrDatos["LSP"]=DB::getSessionProyectos();
			for($i=0; $i<sizeof(self::$arrDatos["LSP"]);$i++){
				$link=self::$arrDatos["LSP"][$i];
				
				self::$arrDatos["PRO"][$link["id_proyecto"]]=DB::getViewUserProyecto($link["id_proyecto"]);
			}

			require_once('vista_lista_proyectos_N.php');
			
			}
		
		}else{
			require_once('vista_inicio.php');
		}
}


//public static petición de VISTA_PROYECTO
public static function is_proyect_request(){
	if(isset($_SESSION['proyecto']))return true;
	return false;
}



//FUNCIONES DE CONTROL DE EVENTOS Y VARIABLES
//
//
//CONTROL DE FORMULARIOS
	public static function controlFormularios(){
	//registro de usuario
		if(isset($_REQUEST["bt_reg"])){

			if(ObjectWizard::registrar()) print "EXITO REGISTRO"; else print "FRACASO";
		}

	//login usuario
		if(isset($_REQUEST['bt_log'])){
			//TODO: comprobar campos vacios
			//
			
			$obj=NULL;

			if(DB::verificarUsuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),$obj)){

				self::session_init($obj);
			}
		}

	//registro proyecto
		if(isset($_REQUEST["bt_crearPro"])){

			if(!self::mismaPeticion()){
				ObjectWizard::crearEntidad("PR");
				$_SESSION['old_REQUEST']=$_REQUEST['id_REQUEST'];
			}
		}

	//registro tarea
		if(isset($_REQUEST["bt_crearTarea"])){

			if(!self::mismaPeticion()){		
				ObjectWizard::crearEntidad("TA");
				$_SESSION['old_REQUEST']=$_REQUEST['id_REQUEST'];
			}
		}

	}

	private static function mismaPeticion(){
		if(!isset($_SESSION['old_REQUEST'])||($_REQUEST['id_REQUEST']!=$_SESSION['old_REQUEST'])){
			return false;
		}
		return true;
	}



//FUNCIONES DE RECOGIDA DE DATOS DE BASE DE DATOS
//
//
//FASES Y TAREAS POR PROYECTO
	private function getDatosProyecto($id_proyecto){
//Si ha desaparecido de la base de datos no lo verifica
//if(anybodyThere($_SESSION["proyecto"])){}	
		self::$arrDatos["FAS"]=DB::getFases($id_proyecto);
		self::$arrDatos["TAR"]=DB::getTareas($id_proyecto,1);
	}
} ?>

<?php class RequestCatcher{


}?>

<?php class DataCollector{

} ?>

<?php class RequestThrower{
	

} ?>

<?php class ObjectWizard{

public static function registrar(){
	//TODO: comprobar campos vacios
	//

	if($_REQUEST["tx_pass"]!=$_REQUEST["tx_pass2"])return false;

	return DB::registroUsuario(self::crearUsuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),$_REQUEST['tx_mail'],TRUE));
}

public static function crearEntidad($tipo){
	if($tipo=="US"){
		self::crearUsuario();
	}
		if($tipo=="PR"){
		self::crearProyecto();
	}
		if($tipo=="FA"){
		self::crearFase();
	}
		if($tipo=="TA"){
		self::crearTarea();
	}
}

private static function crearId($comando){
			$id="";
			$aux="";

			if($comando==0){
				$initTag="US";
				$numero=DB::contarUsuarios()['COUNT(id)'];
			}
			if($comando==1){
				$initTag="PR";
				$numero=DB::contarProyectos()["COUNT(ID)"];
			}
			if($comando==2){
				$initTag="FA";
				$numero=DB::contarFases($id_proyecto)['COUNT(ID)'];
			}
			if($comando==3){
				$initTag="TA";
				$numero=DB::contarTareas($_SESSION["proyecto"])['COUNT(ID)'];
			}


		self::crearCerosId($id,$numero,$aux);

	return $initTag . $aux . $id;
	}
//
//FUNCIÓN GENERAL IDS
//-------------------

private static function crearCerosId(&$id,&$numero,&$aux){
				$contador=0;
				$resto=NULL;
				$id=$numero+1;
				$numero++;

		while($numero>=1){

			$numero=(int)$numero/10;
				$contador+=1;
			}

		$contador2= 5-$contador;
			for($i=0;$i<$contador2;$i++){
				$aux .= '0'; 
			}
		} 
//-----------------------------------------
public static function eliminarProyecto($id){
	return DB::eliminarProyecto($id);
}

private static function crearUsuario($nick,$pass,$email,$new){

	if($new){
		$array["id"]=self::crearId(0);
		$array["nick"]=$nick;
		$array["pass"]=$pass;
		$array["email"]=$email;

		return $user=new User($array);

	}

	return DB::RecuperarUsuario($nick,$pass);
}


	private static function crearProyecto(){
		$atributos=NULL;

		$atributos["id"]=self::crearId(1);
		$atributos["title"]=$_REQUEST["tx_title"];
		$atributos["descripcion"]=$_REQUEST["tx_desc"];

		//con collabs: prueba
		//if(isset($_REQUEST["tx_collabs"]))$atributos["id_collab"]=$_REQUEST["tx_collabs"];
		if(isset($_REQUEST["tx_hidden_collabs"]))$atributos["id_collab"]=json_decode($_REQUEST["tx_hidden_collabs"]);

		//Fecha  límite
		if($_REQUEST["tx_flimit"]!=""){
			//$atributos["fLimit"]=time($_REQUEST["tx_flimit"]);
			$atributos["fLimit"]=$_REQUEST["tx_flimit"]." ".$_REQUEST["tx_flimit_hora"];
		}else{
			$atributos["fLimit"]=NULL;
		}
		return DB::insertarProyecto($atributos);
	}

//OBSOLETO: solo para cuando se crea nuevo proyecto
//class.Fase
/*
	function crearFase(&$atributos,$id_proyecto,$title="DEFAULT",$desc="DEFAULT"){

		$atributos["proyecto_fase"]=$id_proyecto;
		$atributos["id_fase"]=crearIdFase($id_proyecto);

			$atributos["title_fase"]=$title;
			$atributos["descripcion_fase"]=$desc;
	}
*/

//CREAR TAREA
//class.tarea
private static function crearTarea($fase="FA00000"){
	$atributos=NULL;

	$atributos["fase"]=$fase;
	$atributos["id_proyecto"]=$_SESSION["proyecto"];
	$atributos["id"]=self::crearId(3);
	$atributos["id_status"]=1;
	$atributos["title"]=$_REQUEST["tx_title"];
	$atributos["descripcion"]=$_REQUEST["tx_desc"];

	return DB::insertarTarea($atributos);
}
} ?>