<div id="nav" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: rgb(193, 216, 215)">
	<a class="navbar-brand" href="#">BRAND</a>
	<ul class="nav navbar-nav">
		<li>
			<a onclick="xajax_load_main();">Proyectos</a>
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
	<ul class="nav navbar-nav" style="clear:both; background-color: #F1F1F1; width:100%" >
		<li><?php print $_SESSION['proyecto']; ?></li>
		<li><a>Calendar</a></li>
		<li><a>Estadísticas</a></li>
		<li><a>Archive</a></li>
	</ul>
</nav>
</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="top:100px;">

	<div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<h4 style="text-align: center;" >to do</h4>
		
		<?php if($arrayTareas==NULL){ ?>
		<div id="task_display" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<span>Tu proyecto no contiene ninguna tarea</span>
			<button id="bt_newTarea" class="btn btn-primary" onclick="xajax_pintarFormulario();">Crea una tarea</button>
		</div>
		<?php }else{
//ESTO QUEDA ALGO RARO
			foreach($arrayFases as $fase){

			for($i=0;$i<sizeof($arrayTareas[$fase->id]);$i++){

		if($arrayTareas[$fase->id][$i]->id_status==1){ ?>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="border: dotted 1px #000; padding: 20px 20px; margin: 5px;">
				<h4><?php print $arrayTareas[$fase->id][$i]->title; ?></h4>
			</div>
		<?php }
			 } }

		}?>

	</div>
		<div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<h4 style="text-align: center;" >doing</h4>
		
		<?php foreach($arrayFases as $fase){
				for($i=0;$i<sizeof($arrayTareas[$fase->id]);$i++){
				
		if($arrayTareas[$fase->id][$i]->id_status==2){ ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4><?php print $arrayTareas[$fase->id][$id]->title; ?></h4>
		</div>
		<?php }
			 } }
		?>

	</div>
		<div class="col-4 col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<h4 style="text-align: center;" >done</h4>
		
		<?php foreach($arrayFases as $fase){
				for($i=0;$i<sizeof($arrayTareas[$fase->id]);$i++){
				
		if($arrayTareas[$fase->id][$i]->id_status==3){ ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h4><?php print $arrayTareas[$fase->id][$id]->title; ?></h4>
		</div>
		<?php }
			 } }
		?>

	</div>

</div>