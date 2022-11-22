<?php
	session_start();
	if (!isset($_SESSION['logged']))
	{
		header('Location: login');
		exit();
	}
	
	
	
	
	
	
	
	/* System dodawania stron ma działać na zasadzie samodzielnego pisania kodu z późniejszą implementacją pliku wykonywalnego lub poprzez wybranie jednej z 10 możliwości utworzenia strony z wykorzystaniem szablonu (blog,informacje,sklep,galeria,artykół,video,lista,html,contact,) */
	
	/* Dodać opcje wyglądu strony głównej (styl) */
	
	/* Zadbać o różnorodność "elementów" artykółów (zdj,lista,video (wybierane z listy),nagłówek (size: 1,2,3),wyróżnienie,blod,czyssty html,<br>,specjalne tabele do kodu,text (jakby to był plik odpalony w notepad++) oraz itemframe) */
	
	
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
		<?php $option_bar = "<button>+ Dodaj strone</button> (IF)<button>- Usuń strone</button> (IF)<button>- Modyfikuj strone</button>";
		include(E."/panel/bars.php");?>
		<main class="main">
			<section class="container full pages" style="height: calc(100% - 10vh); overflow-y: scroll;">
				<ul>
<?php
/*
if()
{
	for($i = 1; $i <= $pages_c; $i++)
	{
		echo
'					<li>
						<div class="page-container">
							<iframe class="page" src="http://127.0.0.1"></iframe>
						</div>
						// Modyfikuj z potwierdzeniem
						// Usuń z potwierdzeniem
					</li>';
	}
}
else
{
	echo "<li>Brak stron! // Sugestia dodania strony (Przycisk)</li>";
}

*/
?>

					<li>
						<div class="page-container">
							<iframe class="page" src="http://127.0.0.1"></iframe>
						</div>
					</li>
					<li>
						<div class="page-container">
							<iframe class="page" src="http://127.0.0.1"></iframe>
						</div>
					</li>
				</ul>
			</section>
		</main>
	</body>
</html>