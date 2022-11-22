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
		<link rel="stylesheet" href="http://127.0.0.1/assets/css/panel.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
		<script src="http://127.0.0.1/assets/javascript/button.js" type="text/javascript" defer></script>
		<script src="http://127.0.0.1/assets/javascript/pre-view.js" type="text/javascript" defer></script>
	</head>
	<body>
		<?php include(E."/panel/bars.php");?>
		<main class="main">
			<section class="container full" style="height: calc(100% - 10vh);">
				<iframe class="preview full" src="http://127.0.0.1"></iframe>
			</section>
		</main>
	</body>
</html>