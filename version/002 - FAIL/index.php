<?php 
//inicio de sesión
session_start();

	//CLASS
		require_once('class/User.php');
		require_once('class/Proyecto.php');
		require_once('class/Fase.php');
		require_once('class/Tarea.php');

	//DB
	
		require_once('modelo.php');
	//controlador
		require_once('controller.php');
//NEW
		require_once("class/refactorCONTROLLER/Controller.php");

	//XAJAX
		require_once("lib/xajax/xajax_core/xajax.inc.php");
		require_once("objeto_xajax.php");



	//JQUERY
	//	require_once("lib/YepSua/Labs/RIA/JQuery4PHP/YsJQueryAutoloader.php");

	//	YsJQueryAutoloader::register();
	//	YsJQuery::usePlugin(YsJQueryConstant::PLUGIN_JQVALIDATE);

Controller::controlFormularios();
?>

<?php require_once("head.php");?>

	<?php //LLAMADA A VISTAS ?>


		<?php

		Controller::vista_request();

		?>

<?php require_once('foot.php');?>