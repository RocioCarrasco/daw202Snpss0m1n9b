<?php
//FUNCIONES DE CONTROL DE EVENTOS Y VARIABLES
//
//

function controlEventos(){
	//TODO: comprobar campos vacios
	//

	//botón de registro
		if(isset($_REQUEST["bt_reg"])){
			if(registrar()) print "EXITO REGISTRO"; else print "FRACASO";
		}
	//botón de login
		if(isset($_REQUEST['bt_log'])){

			$obj=NULL;
			if(DB::verificarUsuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),$obj)){
				session_init($obj);
			}
		}
	//botón ir a principal
	//	if(isset($_REQUEST['bt_gotoMain'])){
			//ir a buscar datos si no existen
	//	}

	//botón crear proyecto
		if(isset($_REQUEST["bt_crearPro"])){

			if(!isset($_SESSION['old_REQUEST'])||($_REQUEST['id_REQUEST']!=$_SESSION['old_REQUEST'])){
				crearNuevoProyecto();
				$_SESSION['old_REQUEST']=$_REQUEST['id_REQUEST'];
			}
		}
	//botón crear tarea
		if(isset($_REQUEST["bt_crearTarea"])){

			if(!isset($_SESSION['old_REQUEST'])||($_REQUEST['id_REQUEST']!=$_SESSION['old_REQUEST'])){		
				crearTarea();
				$_SESSION['old_REQUEST']=$_REQUEST['id_REQUEST'];
			}
		}

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

			if(!isset($_SESSION['old_REQUEST'])||($_REQUEST['id_REQUEST']!=$_SESSION['old_REQUEST'])){
				crearNuevoProyecto();
				$_SESSION['old_REQUEST']=$_REQUEST['id_REQUEST'];
			}
		}

		if(isset($_REQUEST["bt_crearTarea"])){

			if(!isset($_SESSION['old_REQUEST'])||($_REQUEST['id_REQUEST']!=$_SESSION['old_REQUEST'])){		
				crearTarea();
				$_SESSION['old_REQUEST']=$_REQUEST['id_REQUEST'];
			}
		}

	}
?>