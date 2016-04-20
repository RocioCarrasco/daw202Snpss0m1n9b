<header>

<div class="display_mobile">
	<h1><?php echo $_SESSION['nick']?>: dashboard</h1>

	<div id="mobile_nav_container">
		<nav>

			<ul class="nav_bar">
				<div>sección</div>
				<li class="nav_item active">
					<a href="#">Proyectos</a>
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

		<ul class="nav_bar">
			<div>sección</div>
			<li class="nav_item active">
				<a href="#">Proyectos</a>
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

		<ul class="nav_bar">
			<div>sección</div>
			<li class="nav_item active">
				<a href="#">Proyectos</a>
			</li>
			<li class="nav_item">
				<a class="link_logout"  >LOGOUT</a>
			</li>
			<li class="nav_item">
				<a href="#">Buscar</a>
			</li>
			<li class="nav_item">
				<a href="#">Profile</a>
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
		<li class="nav_item active">
			<a href="#">Proyectos</a>
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

<h1><?php echo $_SESSION['nick']?>: dashboard</h1>
</div>

</header>