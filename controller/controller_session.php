<?php
//
//FUNCIONES DE CONTROL DE SESIÓN Y PÁGINA

function is_session_on(){
	if(isset($_SESSION['user']))return true;
	return false;
}

function session_init($obj){
		$_SESSION['user']=$obj->id;	
		$_SESSION['nick']=$obj->nick;
}

//SIN USO: el cierre de sesión se realiza con _xajax_logOut()
			// function loginOut(){
			// 	if(isset($_REQUEST['cmd'])){
			// 		if($_REQUEST['cmd']==0){
			// 			session_unset($_SESSION);
			// 		}

			// 	}
			// }
			


//MAIN CREACION VISTAS----------------
function vistaRequest(){
	//require_once('head.php');
		if(is_session_on()){
			
			if(is_proyect_request()){
//Si ha desaparecido de la base de datos no lo verifica
//if(anybodyThere($_SESSION["proyecto"])){}
				getDatosProyecto($_SESSION["proyecto"],$arrayFases,$arrayTareas);
				require_once("vista/new_vista_proyecto.php");

			}else{

			$linkSessionProyecto=DB::getSessionProyectos();
			for($i=0; $i<sizeof($linkSessionProyecto);$i++){
				$link=$linkSessionProyecto[$i];
				
				$arrayProyectos[$link["id_proyecto"]]=DB::getViewUserProyecto($link["id_proyecto"]);
			}

			require_once('vista/new_vista_lista_proyectos.php');
			
			}
		
		}else{

			require_once('vista/vista_inicio.php');
		}
	//require_once('foot.php');
}


//petición de VISTA_PROYECTO
function is_proyect_request(){
	if(isset($_SESSION['proyecto']))return true;
	return false;
}


//TODO: funciones nuevas de petición de vistas
function getVistaInicio(){}
function getVistaResumen($entidad=null){}
function getVistaDetalle($entidad=null){}
function getVistaListado($entidad=null){}
?>