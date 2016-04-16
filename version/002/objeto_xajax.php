<?php
	require_once('lib/xajax/xajax_core/xajax.inc.php');

//FUNCIONES
//
//
function load_main(){
	$respuesta=new xajaxResponse();
		unset($_SESSION["proyecto"]);
		$respuesta->redirect('index.php');
	return $respuesta;
}

function load_proyecto($id_proyecto){
	$respuesta=new xajaxResponse();
			$_SESSION["proyecto"]=$id_proyecto;
		$respuesta->redirect('index.php');
	return $respuesta;
}

function logOut(){
	$respuesta=new xajaxResponse();

		session_unset($_SESSION["user"]);
		if(isset($_SESSION["nick"]))session_unset($_SESSION["nick"]);
		if(isset($_SESSION["proyecto"]))session_unset($_SESSION["proyecto"]);
		$respuesta->redirect("index.php");

	return $respuesta;
}

	function pintarContenedor(){}

	function pintarModulo(){
		$respuesta=new xajaxResponse();
		return $respuesta;
	}

	function pintarFormulario(){
		$respuesta=new xajaxResponse();
		$html=NULL;

		if(!is_proyect_request()){
			$html='
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<form action="" method="POST" role="form">
			<legend>Nuevo Proyecto</legend>
				<div class="form-group">
				<label for="tx_title">Nombre del proyecto</label>
				<input type="text" class="form-control" id="tx_title" name="tx_title" placeholder="introduzca nombre de proyecto" />
				</div>

				<div class="form-group">
				<label for="tx_desc">Descripción del proyecto</label>
				<textarea rows="3" cols="5" class="form-control" id="tx_desc" name="tx_desc" placeholder="introduzca descripción"></textarea>
				</div>

				<button id="bt_crearPro" name="bt_crearPro" type="submit" class="btn btn-primary">Crear</button>
			</form>
			</div>
			';

			$respuesta->assign("proyect_display","innerHTML", $html);//En la variable respuesta indicamos que al objeto "mensaje" le asigne el texto de nuestra respuesta
		}else{

			$html='
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<form action="" method="POST" role="form">
			<legend>Nueva Tarea</legend>
				<div class="form-group">
				<label for="tx_title">Nombre de la tarea</label>
				<input type="text" class="form-control" id="tx_title" name="tx_title" placeholder="introduzca nombre de la tarea" />
				</div>

				<div class="form-group">
				<label for="tx_desc">Descripción de la tarea</label>
				<textarea rows="3" cols="5" class="form-control" id="tx_desc" name="tx_desc" placeholder="introduzca descripción"></textarea>
				</div>

				<button id="bt_crearTarea" name="bt_crearTarea" type="submit" class="btn btn-primary">Crear</button>
			</form>
			</div>
			';

			$respuesta->assign("task_display","innerHTML", $html);
		}

		return $respuesta;
	}



//OBJETO XAJAX
	$xajax=new xajax();
		//$xajax->configure("debug",TRUE);

		$xajax->register(XAJAX_FUNCTION,"logOut");
		$xajax->register(XAJAX_FUNCTION,"load_proyecto");
		$xajax->register(XAJAX_FUNCTION,"load_main");
		$xajax->register(XAJAX_FUNCTION,"pintarFormulario");

		$xajax->configure("javascript URI","lib/xajax");
		$xajax->processRequest();
?>