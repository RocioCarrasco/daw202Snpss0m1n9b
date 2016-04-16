<?php
//Variables Globales
	require_once('controller/controller_variables.php');

//Inicio y fin de sesión y llamadas a vistas
	require_once('controller/controller_session.php');
//Creación de objetos e inserción en base de datos
	require_once('controller/controller_objetos.php');
	//Eliminar objetos
		require_once('controller/controller_objetos_del.php');
//Llamada a base de datos
	require_once('controller/controller_dbcall.php');
//Control de eventos y variables
	require_once('controller/controller_eventos.php');

?>