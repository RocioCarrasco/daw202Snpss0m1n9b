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