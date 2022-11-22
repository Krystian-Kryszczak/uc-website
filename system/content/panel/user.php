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
		<?php include(E."/panel/bars.php");?>
		<main class="main">
			<section class="container full" style="height: calc(100% - 10vh);">
				<div class="user">
					<div>
						<img src="#">
					</div>
					<a href="#">permissions</a>
					<a href="#">messege</a>
					<a href="#">delete</a>
				</div>
			</section>
		</main>
	</body>
</html>