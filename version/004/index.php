<?php session_start();


//dependencias------------------
	//OBJETOS
		require_once('clases.php');
	//BD
		require_once('modelo.php');
	//CONTROLADOR
		require_once('controller.php');
	//LIBRERÍAS
		require_once('librerias.php');



// eventos---------------------
	controlFormularios();


// construccion vista----------- 
require_once("vista/head.php");
	vistaRequest();
require_once('vista/foot.php');

?>