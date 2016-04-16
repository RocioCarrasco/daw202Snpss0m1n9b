<?php
//incluido en Controller.php
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

/*
$_REQUEST['cmd']
	Una vez logeado y deslogeado se queda con el valor cmd=0, 
	por lo que no se puede volver a logear a no se que se cambia el
	valor o se elimine la variable manualmente.

	Hay que cambiar el sistema hasta la aplicación de AJAX/JQUERY.
 */

//SIN USO: el cierre de sesión se realiza con _xajax_logOut()
			// function loginOut(){
			// 	if(isset($_REQUEST['cmd'])){
			// 		if($_REQUEST['cmd']==0){
			// 			session_unset($_SESSION);
			// 		}

			// 	}
			// }

//petición de VISTAS
//function vista_request(){}


//petición de VISTA_PROYECTO
function is_proyect_request(){
	if(isset($_SESSION['proyecto']))return true;
	return false;
}
?>