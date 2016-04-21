<header>

<div class="display_mobile">
	<h1><?php echo $_SESSION['nick']?>: dashboard</h1>

		<div id="mobile_nav_container">
		<nav>

			<ul class="nav_bar">
				<div>sección</div>
				<li class="nav_item active">
					<a class="link_vmain">Proyectos</a>
				</li>
				<li class="nav_item">
					<a class="link_logout">LOGOUT</a>
				</li>
				<li class="nav_item">
					<a>Buscar</a>
				</li>
				<li class="nav_item">
					<a>Profile</a>
				</li>	
			</ul>

		<ul class="nav_bar">
			<div>sección</div>
			<li class="nav_item active">
			</li>
			<li class="nav_item">
			</li>
			<li class="nav_item">
			</li>
			<li class="nav_item">
			</li>	
		</ul>

		<ul class="nav_bar">
			<div>sección</div>
			<li class="nav_item active">
			</li>
			<li class="nav_item">
			</li>
			<li class="nav_item">
			</li>
			<li class="nav_item">
			</li>	
		</ul>
		</nav>	
	</div>

	<a class="exit-header-bt header-bt link_logout">S</a>
	<a id="bt_mobile_nav" class="main-header-bt header-bt">IR</a>
	<a class="close-header-bt header-bt">X</a>
</div>


<div class="display_medium">

	<nav>
	<ul class="nav_bar">
		<li class="nav_item">
			<a class="link_vmain">Proyectos</a>
		</li>
		<li class="nav_item">
			<a class="link_logout">LOGOUT</a>
		</li>
		<li class="nav_item">
			<a>Buscar</a>
		</li>
		<li class="nav_item">
			<a>Profile</a>
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
			<li class="nav_item prev"><a><</a></li>
			
			<li class="nav_item"><span>vista actual</span></li>
			
			<li class="nav_item next"><a>></a></li>
		</ul>
	</nav>


	<a class="header-bt-normal">Pr</a>
	<a class="header-bt-normal">St</a>

	<a class="header-bt-normal" id="system_msg_bt">!<span class="n_msg">3</span></a>

<h1><?php echo $_SESSION['proyecto']?>: dashboard</h1>

</div>

</header>