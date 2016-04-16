<?php
function is_session_on(){
	if(isset($_SESSION['user']))return true;

	return false;
}

function session_init($obj){
	//if(isset($_REQUEST['bt_log'])){
	//				

		$_SESSION['user']=$obj->id;	
		//$_REQUEST['cmd']=2;
	//	return TRUE;
	//}

	//return FALSE;
}
/*
$_REQUEST['cmd']
	Una vez logeado y deslogeado se queda con el valor cmd=0, 
	por lo que no se puede volver a logear a no se que se cambia el
	valor o se elimine la variable manualmente.

	Hay que cambiar el sistema hasta la aplicación de AJAX/JQUERY.
 */
function loginOut(){
	if(isset($_REQUEST['cmd'])){
		if($_REQUEST['cmd']==0){
			session_unset($_SESSION);
			//$_REQUEST['cmd']=2;
		}
		/*
		if($_REQUEST['cmd']==1){
			$_REQUEST['bt_reg']=$_REQUEST['cmd'];
		}
		if($_REQUEST['cmd']==2){
			$_REQUEST['bt_reg']=NULL;
		}
		*/
	}
}


//class.USUARIO
function crearIdUsuario(){
	$id="";

	$numero=DB::contarUsuarios()['COUNT(id)'];


	$contador=0;
	$resto=NULL;
	while($numero>=1){
		$resto=$numero%10;
		$resto+=$id;
		$id=$resto;

		$numero=(int)$numero/10;
		$contador+=1;

		print "contador: ".$contador.", resto: ".$resto.", numero: ".$numero."</br>";
	}
	$id++;

	$aux="";
	$contador2= 5-$contador;
	for($i=0;$i<$contador2;$i++){
		$aux .= '0'; 
		print "VUELTA ".$i;
	}

	return 'US' . $aux . $id;
}

function crearUsuario($nick,$pass,$email,$new){

	if($new){
		$array["id"]=crearIdUsuario();
		$array["nick"]=$nick;
		$array["pass"]=$pass;
		$array["email"]=$email;

		return $user=new User($array);

	}

	return DB::RecuperarUsuario($nick,$pass);
}

function registrar(){
	//TODO: comprobar campos vacios
	//

	if($_REQUEST["tx_pass"]!=$_REQUEST["tx_pass2"])return false;

	return DB::registroUsuario(crearusuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),$_REQUEST['tx_mail'],TRUE));
	//crearusuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),$_REQUEST['tx_mail'],TRUE);
	//return true;
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
				//$user=crearusuario($_REQUEST['tx_user'],md5($_REQUEST['tx_pass']),null,FALSE);
				
				//print "<pre>";
				//print_r (var_dump($obj));
				//print "</pre>";

				session_init($obj);
			}else{
				print "NOPE";
			}
		}
	}


?>