<?php
require_once 'htmlExtras/cachosHtml/nav_lista_proyectos.php' ;
?>

<?php 
//ESTO SE PINTA SIEMPRE, PERO POR AHORA NO VA A FUNCIONAR, O SÍ...

?>
<section><article>

	<div id="proyect_display">	
		<button id="bt_newPro" class="btn btn-primary" onclick="xajax_pintarFormulario();">Inicie un nuevo proyecto...</button>
	</div>

</article></section>


<section>
<?php
if($linkSessionProyecto!=NULL){

	for($e=0; $e<sizeof($linkSessionProyecto);$e++){ 
		$pro=$linkSessionProyecto[$e];
		$indice=$pro["id_proyecto"];

		?>

<article id="cont-<?php print $arrayProyectos[$indice][0]['id_proyecto']; ?>">
	<h3><a onclick="xajax_load_proyecto('<?php print $arrayProyectos[$indice][0]['id_proyecto']; ?>');"><?php print $arrayProyectos[$indice][0]['title_proyecto'] ?> || <?php print $arrayProyectos[$indice][0]['fechaLimit_proyecto']?></a></h3>

	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<h5>Descripción</h5>
		<span><?php print $arrayProyectos[$indice][0]['descripcion_proyecto']; ?></span>	
	</div>

	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<?php 
			//$array=$arrayUserProyectos[$proyecto->id];
		?>

	<div>
		<h5>Admin</h5>
<?php for($i=0;$i<sizeof($arrayProyectos[$indice]);$i++){ ?>
		<span><?php if($arrayProyectos[$indice][$i]["id_rango"]==0) print $arrayProyectos[$indice][$i]['nick_user'];

		//print DB::getUser($array[$i]["id_user"])->nick;?></span>
<?php	} ?>
	</div>

	<div>
		<h5>Collaborators</h5>
<?php for($i=0;$i<sizeof($arrayProyectos[$indice]);$i++){ ?>
		<span><?php print $arrayProyectos[$indice][$i]['nick_user'];

?></span>
<?php	} ?>
	</div>

		<div>
			<button onclick="xajax_delProyecto('<?php print $arrayProyectos[$indice][0]['id_proyecto']; ?>');">Eliminar</button>
		</div>
	</div>

</article>

<?php 
}
} ?>
</section>

</div>
