<?php
	require_once('lib/xajax/xajax_core/xajax.inc.php');

//FUNCIONES
//
//

function logOut(){
	$respuesta=new xajaxResponse();

	//if(AccesoDB::verificarUsuario($datos["tx_nombre"],$datos["tx_pass"])){
		session_unset($_SESSION["user"]);
		session_unset($_SESSION["nick"]);
		$respuesta->redirect("index.php");
	//}

	return $respuesta;
}

//
//

	function funcion1(){
		$respuesta=new xajaxResponse();

		return $respuesta;
	}

	function pintarContenedor(){}

	function pintarModulo(){
		$respuesta=new xajaxResponse();

		return $respuesta;
	}

//OBJETO XAJAX
	$xajax=new xajax();
		//$xajax->configure("debug",TRUE);

		$xajax->register(XAJAX_FUNCTION,"logOut");

		$xajax->configure("javascript URI","lib/xajax");
		$xajax->processRequest();
?>