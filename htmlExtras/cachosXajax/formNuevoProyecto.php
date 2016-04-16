<div class="custom_container col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
					<?php echo callAllUsers(); ?>
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

</div>