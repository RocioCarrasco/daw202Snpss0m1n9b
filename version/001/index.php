<?php 
//inicio de sesión
session_start();

	//CLASS
		require_once('class/User.php');
		require_once('class/Proyecto.php');

	//DB
		require_once('modelo.php');
	//controlador
		require_once('controller.php');

	//XAJAX
		require_once("lib/xajax/xajax_core/xajax.inc.php");
		require_once("objeto_xajax.php");

	//JQUERY
		require_once("lib/YepSua/Labs/RIA/JQuery4PHP/YsJQueryAutoloader.php");

		YsJQueryAutoloader::register();
		YsJQuery::usePlugin(YsJQueryConstant::PLUGIN_JQVALIDATE);

	//variables
		$arrayProyectos=NULL;
		$arrayUserProyectos=NULL;
		$arrayUsuarios=NULL;

		$arraySessionProyecto=NULL;



controlFormularios();

//fin de sesión
//loginOut();

?>

<?php require_once("head.php");?>

	<?php //LLAMADA A VISTAS ?>


		<?php
//print "<pre>";
//print_r ($_SESSION);
//print "</pre>";

		if(is_session_on()){
			
			
			//$arrayProyectos=DB::getProyectos();

			//foreach ($arrayProyectos as $proyecto) {
			//	$indice=$proyecto->id;
			//	$arrayUserProyectos[$proyecto->id]=DB::getUserProyectos($proyecto->id);
			//}
			
		
			$linkSessionProyecto=DB::getSessionProyectos();
			for($i=0; $i<sizeof($linkSessionProyecto);$i++){
				$link=$linkSessionProyecto[$i];
				//$arrayProyectos[]=DB::getDatosProyecto($link["id_proyecto"]);
				$arrayProyectos[$link["id_proyecto"]]=DB::getViewUserProyecto($link["id_proyecto"]);
			}
			
			//print "<pre>";
			//print_r($linkSessionProyecto);
			//print_r($arrayProyectos);
			//print "</pre>";
			

			require_once('vista_lista_proyectos.php');
		
		}else{
			
			//controlFormularios();
			require_once('vista_inicio.php');
		}
		?>

<?php require_once('foot.php');?>