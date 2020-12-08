<div class="header">
	<section class="container">
		<img src="assets/img/logo.png" alt="logo" />
		<h1>Persatuan Ragbi UMP</h1>
	</section>
</div>

<nav class="navbar navbar-default">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header" style="color: #fff;">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
			</button>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li class="<?php echo ($_SERVER['SCRIPT_NAME'] == '/index.php') ? 'active' : ''; ?>"><a href="/">Home <span class="sr-only">(current)</span></a></li>
				<li class="<?php echo ($_SERVER['SCRIPT_NAME'] == '/news.php') ? 'active' : ''; ?>"><a href="news.php">News</a></li>
				<li class="<?php echo ($_SERVER['SCRIPT_NAME'] == '/gallery.php') ? 'active' : ''; ?>"><a href="gallery.php">Gallery</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="user/login.php">Login</a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>