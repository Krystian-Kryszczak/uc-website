<?php
	session_start();
	if (!isset($_SESSION['logged']))
	{
		header('Location: login');
		exit();
	}
?>
<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Web</title>
		<link rel="stylesheet" type="text/css" href="http://127.0.0.1/assets/css/panel.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
		<script src="http://127.0.0.1/assets/javascript/button.js" type="text/javascript" defer></script>
	</head>
	<body>
		<section class="option-bar">
			<?php echo "Witaj ".$_SESSION['user']." !"; ?>
		</section>
		<section class="sidebar">
			<div class="menu-button">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<nav class="menu">
				<ul>
					<li><a href="dashboard"><i class="fas fa-desktop"></i></a></li>
					<li><a href="articules"><i class="fas fa-file-alt"></i></a></li>
					<li><a href="preview"><i class="far fa-eye"></i></a></li>
					<li><a href="personalization"><i class="fas fa-palette"></i></a></li>
					<li><a href="activity"><i class="fas fa-book"></i></a></li>
					<li><a href="settings"><i class="fas fa-cog"></i></a></li>
					<li><a href="users"><i class="fas fa-users-cog"></i></a></li>
					<li><a href="pages"><i class="fas fa-file"></i></a></li>
				</ul>
			</nav>
		</section>
		<main class="main">
			<section class="container full" style="height: calc(100% - 10vh);">
				<form class="form" action="#" method="POST">
					<ul class="inputs">
						<li>Domena strony <input type="text" name="domain" value="Example.com"></li>
					</ul>
					<ul class="checkboxs">
						<li><input type="checkbox" name="preloader" checked><span>Preloader</span></li>
						<li><input type="checkbox" name="newslatter" checked><span>Newslatter</span></li>
						<li><input type="checkbox" name="cookies" checked><span>Cookies</span></li>
						<li><input type="checkbox" name="adds" checked><span>Reklamy</span></li>
						<li><input type="checkbox" name="403" checked><span>403</span></li>
						<li><input type="checkbox" name="404" checked><span>404</span></li>
					</ul>
					<ul class="ranges">
						<li><span class="count">5</span> <input type="range" min="0" max="25" value="5" name="text-size"><span> XYZ</span></li><br/>
					</ul>
					<input type="submit" value="SAVE">
				</form>
			</section>
		</main>
	</body>
</html>