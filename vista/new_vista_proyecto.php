<?php
require_once 'htmlExtras/cachosHtml/nav_proyecto.php' ;
?>

<?php 
	//require_once "htmlExtras/cachosHtml/popMenuDemo.php";
	require_once "htmlExtras/cachosHtml/asideDemo.php";

?>

<div id="main">

<!--tiene que ir al aside-->
<section>
	<header>
		<h2>crea una tarea o muere</h2>
	</header>
	<div class="article_group">
	<article>
		<div id="task_display">
			<?php if($arrayTareas==NULL){
			?>
				<p>Tu proyecto no contiene ninguna tarea.</p>
			<?php	
			}?>
			<button id="bt_newTarea" class="btn btn-primary" onclick="xajax_pintarFormulario();">Crea una tarea</button>
		</div>
	</article>	
	<div class="clear"></div>
	</div>
</section>

<?php if($arrayTareas!=NULL){ ?>
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
		<h2>tarea creadas</h2>
	</header>


<div class="article_group">
	<article>
	<div>
		<h4 style="text-align: center;" >to do</h4>
		
	
		<?php 
			foreach($arrayFases as $fase){

			for($i=0;$i<sizeof($arrayTareas[$fase->id]);$i++){

		if($arrayTareas[$fase->id][$i]->id_status==1){ ?>
			<div style="border: dotted 1px #000; padding: 20px 20px; margin: 5px;">
				<h4><?php print $arrayTareas[$fase->id][$i]->title; ?></h4>
			</div>
		<?php }
			 } }

		?>

	</div>
	</article>

	<article>
		<div>
		<h4 style="text-align: center;" >doing</h4>
		
		<?php foreach($arrayFases as $fase){
				for($i=0;$i<sizeof($arrayTareas[$fase->id]);$i++){
				
		if($arrayTareas[$fase->id][$i]->id_status==2){ ?>
		<div>
			<h4><?php print $arrayTareas[$fase->id][$id]->title; ?></h4>
		</div>
		<?php }
			 } }
		?>

	</div>
	</article>

	<article>
		<div>
		<h4 style="text-align: center;" >done</h4>
		
		<?php foreach($arrayFases as $fase){
				for($i=0;$i<sizeof($arrayTareas[$fase->id]);$i++){
				
		if($arrayTareas[$fase->id][$i]->id_status==3){ ?>
		<div>
			<h4><?php print $arrayTareas[$fase->id][$id]->title; ?></h4>
		</div>
		<?php }
			 } }

		?>

	</div>
	<article>

	<div class="clear"></div>
</div>


</section>
<?php } ?>
</div>