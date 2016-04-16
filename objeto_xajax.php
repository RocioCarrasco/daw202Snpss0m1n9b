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


// TODO: COMPONENTES MODULARES
// 
// 
// 
	function pintarContenedor(){}

	function pintarModulo(){
		$respuesta=new xajaxResponse();
		return $respuesta;
	}
// 
// 
// 
// FIN TODO ..........................


	function pintarFormulario(){
		$respuesta=new xajaxResponse();
		$html=NULL;
		/*
		Si se usa el método 'is_proyect_request()'
		sólo se pueden crear proyectos si no existe ninguno.

		Entiendo que sólo se puedan crear tareas si existen proyectos
		y estos han sido llamados. Hay que meter cirugía aquí.
		 */
		if(!is_proyect_request()){
			$select=callAllUsers();

$html='<div class="custom_container col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<form action="" method="POST" role="form">

			<legend>Nuevo Proyecto</legend>

			<fieldset>
	<legend>Información básica</legend>

		<div class="form_fields_cont">
				<div class="form-group">
				<label for="tx_title">Nombre del proyecto</label>
				<input type="text" class="form-control" id="tx_title" name="tx_title" placeholder="introduzca nombre de proyecto" />
			</div>

			<div class="form-group">
				<label for="tx_desc">Descripción del proyecto</label>
				<textarea rows="3" cols="5" class="form-control" id="tx_desc" name="tx_desc" placeholder="introduzca descripción"></textarea>
			</div>

		</div>
			</fieldset>

			<fieldset>
	<legend>Roles</legend>
			<div class="form_fields_cont">	
				<div class="form-group">

					<label for="tx_collabs">Añadir colaboradores</label>
					'.$select.'
					<input style="display:none;" type="hidden" id="tx_hidden_collabs" name="tx_hidden_collabs"/>
				</div>

			</div>

			<input type="hidden" id="id_REQUEST" name="id_REQUEST">

			</fieldset>

			<fieldset>
	<legend>Extra</legend>
			<div class="form_fields_cont">
				<div class="form-group">
				<label for="tx_title">Fecha límite</label>
				<input type="date" class="form-control" id="tx_flimit" name="tx_flimit" placeholder="introduzca fecha límite" />
				<input type="time" class="form-control" id="tx_flimit_hora" name="tx_flimit_hora" placeholder="introduzca hora" />
				</div>
			</div>
			</fieldset>
	
					<button id="bt_crearPro" name="bt_crearPro" type="submit" class="btn btn-primary" onclick="antesNuevoPro();" >Crear</button>

			</form>

</div>';

			$respuesta->assign("proyect_display","innerHTML", $html);//En la variable respuesta indicamos que al objeto "mensaje" le asigne el texto de nuestra respuesta
		}else{

			$html='
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<form action="" method="POST" role="form">
			<legend>Nueva Tarea</legend>
			<div class="form_fields_cont">
				<div class="form-group">
				<label for="tx_title">Nombre de la tarea</label>
				<input type="text" class="form-control" id="tx_title" name="tx_title" placeholder="introduzca nombre de la tarea" />
				</div>

				<div class="form-group">
				<label for="tx_desc">Descripción de la tarea</label>
				<textarea rows="3" cols="5" class="form-control" id="tx_desc" name="tx_desc" placeholder="introduzca descripción"></textarea>
				</div>
				</div>

							<input type="hidden" id="id_REQUEST" name="id_REQUEST" >
							
				<button id="bt_crearTarea" name="bt_crearTarea" type="submit" class="btn btn-primary" onclick="antesNuevoTar();">Crear</button>
			</form>
			</div>
			';

			$respuesta->assign("task_display","innerHTML", $html);
		}

		return $respuesta;
	}

//ELIMINAR COSAS
function delProyecto($id){
		$respuesta=new xajaxResponse();
		
		if(eliminarProyecto($id)){
			$tagID="cont-".$id;
			$respuesta->remove($tagID);
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
		$xajax->register(XAJAX_FUNCTION,"delProyecto");

		$xajax->configure("javascript URI","lib/xajax");
		$xajax->processRequest();



//FUERA DE XAJAX
	function callAllUsers(){
		//$respuesta=new xajaxResponse();
		$html='';

		$html.='<select id="tx_collabs" name="tx_collabs" size="4" onclick="" multiple>';
			$listaUsers=DB::consultarUsuariosEx($_SESSION["user"]);

			$it=0;
			$idOption="tx_collabs_opc".$it;
		//$html.='<option id="'.$idOption.'" value="" onclick="seleccionar(\''.$idOption.'\');" selected> - </option>';
			
			foreach ($listaUsers as $user) {
				$it++;
				$idOption="tx_collabs_opc".$it;
				$html.='<option id="'.$idOption.'" value="'.$user->id.'" onclick="seleccionar(\''.$idOption.'\');" >'.$user->nick.'</option>';
			}
		
		$html.='</select>';

			//$respuesta->assign("tx_collabs","innerHTML", $html);

		//return $respuesta;
		return $html;
	}
?>