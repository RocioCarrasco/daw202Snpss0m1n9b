<?php
require_once 'htmlExtras/cachosHtml/nav_lista_proyectos.php' ;
?>

<?php 
	require_once "htmlExtras/cachosHtml/asideDemo.php";
?>

<main role="main" id="main">

<!--esto debe ir a ASIDE-->
<!--
<section>

	<article>

	<div id="proyect_display">	
		<button id="bt_newPro" class="btn btn-primary" onclick="xajax_pintarFormulario();">Inicie un nuevo proyecto...</button>
	</div>

</article>

</section>
-->


<section>
	<header>
		<menu>
					<ul class="menu_bar">
						<li class="menu_item"><a alt="comando" href="">o</a></li>
						<li class="menu_item"><a alt="comando" href="">o</a></li>
						<li class="menu_item"><a alt="comando" href="">o</a></li>
					</ul>
		</menu>
		|
				<menu>
					<ul class="menu_bar">
						<li class="menu_item"><a alt="comando" href="">o</a></li>
						<li class="menu_item"><a alt="comando" href="">o</a></li>
						<li class="menu_item"><a alt="comando" href="">o</a></li>
					</ul>
				</menu>
		<h2>proyectos creados <a>v</a></h2>
	</header>

<div class="article_group">
<?php
if($linkSessionProyecto!=NULL){

	for($e=0; $e<sizeof($linkSessionProyecto);$e++){ 
		$pro=$linkSessionProyecto[$e];
		$indice=$pro["id_proyecto"];

		?>

<article id="cont-<?php print $arrayProyectos[$indice][0]['id_proyecto']; ?>">
	<h3><a onclick="xajax_load_proyecto('<?php print $arrayProyectos[$indice][0]['id_proyecto']; ?>');"><?php print $arrayProyectos[$indice][0]['title_proyecto'] ?> || <?php print $arrayProyectos[$indice][0]['fechaLimit_proyecto']?></a></h3>

	<div>
		<h5>Descripción</h5>
		<span><?php print $arrayProyectos[$indice][0]['descripcion_proyecto']; ?></span>	
	</div>

	<div>
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
			<button>accion</button>
			<button>accion</button>
			<button onclick="xajax_delProyecto('<?php print $arrayProyectos[$indice][0]['id_proyecto']; ?>');">Eliminar</button>
		</div>
	</div>

</article>

<?php 
}
} ?>

<div class="clear"></div>
</div>

<menu> opciones </menu>
</section>

<section>
		<header>
		<menu>
					<ul class="menu_bar">
						<li class="menu_item"><a alt="comando" href="">o</a></li>
						<li class="menu_item"><a alt="comando" href="">o</a></li>
						<li class="menu_item"><a alt="comando" href="">o</a></li>
					</ul>
		</menu>
		|
				<menu>
					<ul class="menu_bar">
						<li class="menu_item"><a alt="comando" href="">o</a></li>
						<li class="menu_item"><a alt="comando" href="">o</a></li>
						<li class="menu_item"><a alt="comando" href="">o</a></li>
					</ul>
				</menu>
		<h2>título seccion</h2>
	</header>
	<div class="article_group">
	</div>
	<menu> opciones </menu>
</section>

</main>
</div>
