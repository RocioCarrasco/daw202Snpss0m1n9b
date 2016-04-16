<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: rgb(193, 216, 215)">
	<a class="navbar-brand" href="#">BRAND</a>
	<ul class="nav navbar-nav">
		<li class="active">
			<a href="#">Proyectos</a>
		</li>
		<li>
			<a href="index.php?cmd=0">LOGOUT</a>
		</li>
		<li>
			<a href="#">Inscribirse</a>
		</li>
		<li>
			<a href="#">Buscar</a>
		</li>
		<li>
			<a href="#">Info</a>
		</li>
	</ul>
</nav>
</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
</div>

<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">

<?php foreach ($arrayProyectos as $proyecto) { ?>
 
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="border: solid 1px #f1f1f1; background-color: #f1f1f1; padding-bottom: 30px;" >
	<h3><?php print $proyecto->title; ?></h3>

	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<h5>Descripción</h5>
		<span><?php print $proyecto->descripcion; ?></span>	
	</div>

	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
		<?php 
			$array=$arrayUserProyectos[$proyecto->id];
		?>

	<div>
		<h5>Admin</h5>
<?php for($i=0;$i<sizeof($array);$i++){ ?>
		<span><?php if($array[$i]["id_rango"]==0) print DB::getUser($array[$i]["id_user"])->nick;?></span>
<?php	} ?>
	</div>

	<div>
		<h5>Collaborators</h5>
<?php for($i=0;$i<sizeof($array);$i++){ ?>
		<span><?php print DB::getUser($array[$i]["id_user"])->nick;?></span>
<?php	} ?>
	</div>


	</div>
</div>

<?php } ?>

</div>
</div>