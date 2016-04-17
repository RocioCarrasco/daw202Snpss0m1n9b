<header>

<div class="display_mobile">
	<a class="exit-header-bt header-bt" href="">S</a>
	<a class="main-header-bt header-bt" href="">IR</a>
	<a class="close-header-bt header-bt" href="">X</a>
</div>


<div class="display_medium">

	<nav>
	<ul class="nav_bar">
		<li class="nav_item">
			<a onclick="xajax_load_main();">Proyectos</a>
		</li>
		<li class="nav_item">
			<a id="link_logout" onclick="xajax_logOut();" >LOGOUT</a>
		</li>
		<li class="nav_item">
			<a href="#">Buscar</a>
		</li>
		<li class="nav_item">
			<a href="#">Profile</a>
		</li>	
	</ul>
	<ul class="nav_bar" >
		<li class="nav_item"><?php print $_SESSION['proyecto']; ?></li>
		<li class="nav_item"><a>Calendar</a></li>
		<li class="nav_item"><a>Estadísticas</a></li>
		<li class="nav_item"><a>Archive</a></li>
	</ul>
</nav>

	<nav>
		<ul class="nav_bar">
			<li class="nav_item prev"><a href=""><</a></li>
			
			<li class="nav_item"><span>vista actual</span></li>
			
			<li class="nav_item next"><a href="">></a></li>
		</ul>
	</nav>


	<a class="header-bt-normal" href="">Pr</a>
	<a class="header-bt-normal" href="">St</a>

	<a class="header-bt-normal" id="system_msg_bt" href="">!<span class="n_msg">3</span></a>

<h1><?php echo $_SESSION['proyecto']?>: dashboard</h1>

</div>

</header>