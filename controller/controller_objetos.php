<?php
//
//FUNCIONES DE CREACION DE OBJETOS

//CREACIÓN DE USUARIOS
//
//
//class.USUARIO
function crearIdUsuario(){
	$id="";
	$aux="";

	$numero=DB::contarUsuarios()['COUNT(id)'];
	crearCerosId($id,$numero,$aux);

	return 'US' . $aux . $id;
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
}



//CREAR PROYECTO
//
//class.Proyecto
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
//OBSOLETO: La fase default se crea por TRIGGER
		//crearNuevaFase($atributos,$atributos["id"]);

		return DB::insertarProyecto($atributos);
	}
//class.Fase
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
//class.tarea
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

//
//FUNCIÓN GENERAL IDS
//-------------------

		function crearCerosId(&$id,&$numero,&$aux){
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
?>