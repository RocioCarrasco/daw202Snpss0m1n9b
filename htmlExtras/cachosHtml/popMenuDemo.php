<section id="pop-menu">

	<div class="menu_pop">
		<h2 class="tag_pop">Crear nuevo proyecto</h2>
		<h2>cerrar</h2><a class="bt bt_cerrar" href="">x</a>
	</div>
	
	<!--
	<form>
	<h2>datos</h2>
		<div class="form_group">
			<label>nombre</label><input>
		</div>
		<div class="form_group">
			<label>apellido</label><input>
		</div>
	<h2>más datos</h2>
		<div class="form_group">
			<label>campo</label><input>
		</div>
		<div class="form_group">
			<label>eliotropo</label><input>
		</div>
		<div class="form_group">
			<button>accion</button>
		</div>



	</form>
-->
<!-- ==========================-->
<form action="" method="POST" role="form">

	<h2>datos</h2>
		<div class="form_group">
				<label for="tx_title">Nombre del proyecto</label>
				<input type="text" class="form-control" id="tx_title" name="tx_title" placeholder="introduzca nombre de proyecto" />
		</div>

		<div class="form_group">
			<label for="tx_desc">Descripción del proyecto</label>
			<textarea rows="3" cols="5" class="form-control" id="tx_desc" name="tx_desc" placeholder="introduzca descripción"></textarea>
		</div>

		</div>

	<h2>Roles</h2>
		<div class="form_group">
			<label for="tx_collabs">Añadir colaboradores</label>
			<?php echo callAllUsers(); ?>
			<input style="display:none;" type="hidden" id="tx_hidden_collabs" name="tx_hidden_collabs"/>
		</div>

			<input type="hidden" id="id_REQUEST" name="id_REQUEST">

	<h2>Fecha límite</h2>
		<div class="form_group">
			<label for="tx_title">Fecha límite</label>
			<input type="date" class="form-control" id="tx_flimit" name="tx_flimit" placeholder="introduzca fecha límite" />
			<input type="time" class="form-control" id="tx_flimit_hora" name="tx_flimit_hora" placeholder="introduzca hora" />
		</div>

	<div class="form_group">
		<button id="bt_crearPro" name="bt_crearPro" type="submit" class="btn btn-primary" onclick="antesNuevoPro();" >Crear</button>
	</div>

</form>


</section>