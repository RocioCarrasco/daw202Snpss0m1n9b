

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="left: 25%;">

<h1 style="text-align: center; padding: 2em;">Brand</h1>

<form action="" method="POST" role="form">

<?php
	if(isset($_REQUEST['cmd'])&&$_REQUEST['cmd']==1){
?>
<legend>Registro de usuario</legend>
	<div class="form-group">
		<label for="tx_user">e-mail</label>
		<input type="text" class="form-control" id="tx_mail" name="tx_mail" placeholder="introduzca nombre de usuario">
	</div>

	<div class="form-group">
		<label for="tx_user">usuario</label>
		<input type="text" class="form-control" id="tx_user" name="tx_user" placeholder="introduzca nombre de usuario">
	</div>

	<div class="form-group">
		<label for="tx_pass">contraseña</label>
		<input type="password" class="form-control" id="tx_pass" name="tx_pass" placeholder="introduzca contraseña">
	</div>

	<div class="form-group">
		<label for="tx_pass">repite contraseña</label>
		<input type="password" class="form-control" id="tx_pass2" name="tx_pass2" placeholder="repita contraseña">
	</div>

	<button id="bt_reg" name="bt_reg" type="submit" class="btn btn-primary" style="background-color: #42CA60;
border-color: #42CA60;" >Registrar</button>
	<a href="index.php?cmd=2">Iniciar sesión</a>

<?php	
	}else{
?>
<legend>Inicio de sesión</legend>
	<div class="form-group">
		<label for="tx_user">usuario</label>
		<input type="text" class="form-control" id="tx_user" name="tx_user" placeholder="introduzca nombre de usuario">
	</div>

	<div class="form-group">
		<label for="tx_pass">contraseña</label>
		<input type="password" class="form-control" id="tx_pass" name="tx_pass" placeholder="introduzca contraseña">
	</div>

	<button id="bt_log" name="bt_log" type="submit" class="btn btn-primary">Log in</button>
	<a href="index.php?cmd=1">Registrarse</a>

<?php	
	}
?>

</form>
</div>