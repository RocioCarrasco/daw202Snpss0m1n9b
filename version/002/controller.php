<?php
function is_session_on(){
	if(isset($_SESSION['user']))return true;

	return false;
}
function is_proyect_request(){
	if(isset($_SESSION['proyecto']))return true;

	return false;
}

function session_init($obj){
	//if(isset($_REQUEST['bt_log'])){
	//				

		$_SESSION['user']=$obj->id;	
		$_SESSION['nick']=$obj->nick;
		//$_REQUEST['cmd']=2;
	//	return TRUE;
	//}

	//return FALSE;
}
/*
$_REQUEST['cmd']
	Una vez logeado y deslogeado se queda con el valor cmd=0, 
	por lo que no se puede volver a logear a no se que se cambia el
	valor o se elimine la variable manualmente.

	Hay que cambiar el sistema hasta la aplicación de AJAX/JQUERY.
 */
function loginOut(){
	if(isset($_REQUEST['cmd'])){
		if($_REQUEST['cmd']==0){
			session_unset($_SESSION);
			//$_REQUEST['cmd']=2;
		}
		/*
		if($_REQUEST['cmd']==1){
			$_REQUEST['bt_reg']=$_REQUEST['cmd'];
		}
		if($_REQUEST['cmd']==2){
			$_REQUEST['bt_reg']=NULL;
		}
		*/
	}
}
/*
function loginOutJQ(){
		if(isset($_SESSION['user'])){
		session_unset($_SESSION);
		@header('location:index.php');
		exit();
	}
}
*/



//class.USUARIO
function crearIdUsuario(){
	$id="";
	$aux="";

	$numero=DB::contarUsuarios()['COUNT(id)'];

	/*
	$contador=0;
	$resto=NULL;
	while($numero>=1){
		$resto=$numero%10;
		$resto+=$id;
		$id=$resto;

		$numero=(int)$numero/10;
		$contador+=1;

		//print "contador: ".$contador.", resto: ".$resto.", numero: ".$numero."</br>";
	}
	$id++;

	$aux="";
	$contador2= 5-$contador;
	for($i=0;$i<$contador2;$i++){
		$aux .= '0'; 
		//print "VUELTA ".$i;
	}
	*/
	crearCerosId($id,$numero,$aux);

	return 'US' . $aux . $id;
}
	//-------------------
			function crearCerosId(&$id,&$numero,&$aux){
					$contador=0;
					$resto=NULL;
				while($numero>=1){
					$resto=$numero%10;
					$resto+=$id;
					$id=$resto;

					$numero=(int)$numero/10;
					$contador+=1;
				}
				$id++;

				$contador2= 5-$contador;
				for($i=0;$i<$contador2;$i++){
					$aux .= '0'; 
				}
			} 

function crearUsuario($nick,$pass,$email,$new){

	if($new){
		$array["id"]=crearIdUsuario();
		$array["nick"]=$nick;
		$array["pass"]=$pass;
		$array["email"]=$email;

		return $user=new User($array);

	}

	return DB::RecuperarUsuario($nick,$pass);
}

function registrar(){
	//TODO: comprobar campos vacios
	//

	if($_REQUEST["tx_pass"]!=$_REQUEST["tx_pass2"])return false;

	return DB::registroUsuario(crearusuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),$_REQUEST['tx_mail'],TRUE));
	//crearusuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),$_REQUEST['tx_mail'],TRUE);
	//return true;
}

//CONTROL DE FORMULARIOS
	function controlFormularios(){
		if(isset($_REQUEST["bt_reg"])){

			if(registrar()) print "EXITO REGISTRO"; else print "FRACASO";
		}
		if(isset($_REQUEST['bt_log'])){
			//TODO: comprobar campos vacios
			//
			
			$obj=NULL;

			if(DB::verificarUsuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),$obj)){

				session_init($obj);
			}
		}
		if(isset($_REQUEST["bt_crearPro"])){
			crearNuevoProyecto();

		}
		if(isset($_REQUEST["bt_crearTarea"])){
			crearTarea();
		}

	}

//FASES Y TAREAS POR PROYECTO
	function getDatosProyecto($id_proyecto,&$arrayFases,&$arrayTareas){
		$arrayFases=DB::getFases($id_proyecto);
		$arrayTareas=DB::getTareas($id_proyecto,1);
	}


//CREAR PROYECTO
	function crearIdProyecto(){
	$id="";
	$aux="";

	$numero=DB::contarProyectos()["COUNT(ID)"];

		crearCerosId($id,$numero,$aux);

	return 'PR' . $aux . $id;
	}

	function crearNuevoProyecto(){
		$atributos=NULL;

		$atributos["id"]=crearIdProyecto();
		$atributos["title"]=$_REQUEST["tx_title"];
		$atributos["descripcion"]=$_REQUEST["tx_desc"];

		crearNuevaFase($atributos,$atributos["id"]);

		return DB::insertarProyecto($atributos);
	}

	function crearNuevaFase(&$atributos,$id_proyecto,$title="DEFAULT",$desc="DEFAULT"){

		$atributos["proyecto_fase"]=$id_proyecto;
		$atributos["id_fase"]=crearIdFase($id_proyecto);

			$atributos["title_fase"]=$title;
			$atributos["descripcion_fase"]=$desc;
	}

	function crearIdFase($id_proyecto){
			$id="";
			$aux="";

			$numero=DB::contarFases($id_proyecto)['COUNT(ID)'];


		crearCerosId($id,$numero,$aux);


	return 'FA' . $aux . $id;
	}

//CREAR TAREA

function crearTarea($fase="FA00000"){
	$atributos=NULL;

	$atributos["fase"]=$fase;
	$atributos["id_proyecto"]=$_SESSION["proyecto"];
	$atributos["id"]=crearIdTarea();
	$atributos["id_status"]=1;
	$atributos["title"]=$_REQUEST["tx_title"];
	$atributos["descripcion"]=$_REQUEST["tx_desc"];

	return DB::insertarTarea($atributos);
}

	function crearIdTarea(){
			$id="";
			$aux="";

			$numero=DB::contarTareas($_SESSION["proyecto"])['COUNT(ID)'];


		crearCerosId($id,$numero,$aux);

	return 'TA' . $aux . $id;
	}

?>