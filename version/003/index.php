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

	//XAJAX
		require_once("lib/xajax/xajax_core/xajax.inc.php");
		require_once("objeto_xajax.php");

	//JQUERY
	//	require_once("lib/YepSua/Labs/RIA/JQuery4PHP/YsJQueryAutoloader.php");

	//	YsJQueryAutoloader::register();
	//	YsJQuery::usePlugin(YsJQueryConstant::PLUGIN_JQVALIDATE);

	//variables
		$arrayProyectos=NULL;

			//SIN USO actualmente
				$arrayUserProyectos=NULL;
				$arrayUsuarios=NULL;

				$arraySessionProyecto=NULL;

		$arrayFases=NULL;
		$arrayTareas=NULL;

controlFormularios();
?>

<?php require_once("head.php");?>

	<?php //LLAMADA A VISTAS ?>


		<?php

		if(is_session_on()){
			
			if(is_proyect_request()){
//Si ha desaparecido de la base de datos no lo verifica
//if(anybodyThere($_SESSION["proyecto"])){}
				getDatosProyecto($_SESSION["proyecto"],$arrayFases,$arrayTareas);
				require_once("vista_proyecto.php");

			}else{

			$linkSessionProyecto=DB::getSessionProyectos();
			for($i=0; $i<sizeof($linkSessionProyecto);$i++){
				$link=$linkSessionProyecto[$i];
				
				$arrayProyectos[$link["id_proyecto"]]=DB::getViewUserProyecto($link["id_proyecto"]);
			}
			
			//print "<pre>";
			//print_r($linkSessionProyecto);
			//print_r($arrayProyectos);
			//print "</pre>";
			

			require_once('vista_lista_proyectos.php');
			
			}
		
		}else{
			
			//controlFormularios();
			require_once('vista_inicio.php');
		}
		?>

<?php require_once('foot.php');?>