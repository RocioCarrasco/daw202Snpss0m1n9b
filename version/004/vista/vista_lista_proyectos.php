<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 -->
<!-- 	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: rgb(193, 216, 215)">
	 -->
	<nav>
	 <a class="navbar-brand" href="#">BRAND</a>
		<ul class="nav navbar-nav">
		<li class="active">
			<a href="#">Proyectos</a>
		</li>
		<li>
			<a id="link_logout" onclick="xajax_logOut();" >LOGOUT</a>
		</li>
		<li>
			<a href="#">Buscar</a>
		</li>
		<li>
			<a href="#">Profile</a>
		</li>	
	</ul>
</nav>

<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="top: 176px">
 -->
<div id="main">

<!-- 
	ESTO ESTABA PARA INDENTAR
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
</div>
 
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
-->

<?php 
//ESTO SE PINTA SIEMPRE, PERO POR AHORA NO VA A FUNCIONAR, O SÍ...

?>
<section><article>
<!-- 	<div id="proyect_display" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="padding: 30px 50px; border: dotted 1px #000;">
	 -->
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

<!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border: solid 1px #f1f1f1; background-color: #f1f1f1; padding-bottom: 30px;" >
	 -->
<article id="cont-<?php print $arrayProyectos[$indice][0]['id_proyecto']; ?>">
	<h3><a onclick="xajax_load_proyecto('<?php print $arrayProyectos[$indice][0]['id_proyecto']; ?>');"><?php print $arrayProyectos[$indice][0]['title_proyecto'] ?></a></h3>

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
<!-- </div> -->
<?php 
}
} ?>
</section>

</div>
<!-- </div> -->