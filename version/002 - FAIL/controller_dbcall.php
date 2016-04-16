<?php
//incluido en Controller.php
//FUNCIONES DE RECOGIDA DE DATOS DE BASE DE DATOS
//
//
//FASES Y TAREAS POR PROYECTO
	function getDatosProyecto($id_proyecto,&$arrayFases,&$arrayTareas){
//Si ha desaparecido de la base de datos no lo verifica
//if(anybodyThere($_SESSION["proyecto"])){}	
		$arrayFases=DB::getFases($id_proyecto);
		$arrayTareas=DB::getTareas($id_proyecto,1);
	}

?>