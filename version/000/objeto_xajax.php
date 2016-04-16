<?php
	require_once('lib/xajax/xajax_core/xajax.inc.php');

//FUNCIONES
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
		$xajax->configure("debug",TRUE);

		$xajax->register(XAJAX_FUNCTION,"funcion1");

		$xajax->configure("javascript URI","lib/xajax");
		$xajax->processRequest();
?>