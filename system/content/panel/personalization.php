<?php
session_start();
if (!isset($_SESSION['logged']))
{
	header('Location: login');
	exit();
}
if(isset($_POST))
{
/* Początek pliku */
$fp = fopen(IMPATH."/assets/css/--.css", "w");
fputs($fp, ":root
{
");
fclose($fp);
/* Zmienne CSS'a */
$fp = fopen(IMPATH."/assets/css/--.css", "a");
foreach ($_POST as $parametr=> $wartosc)
{
fputs($fp, "	--".$parametr.": ".$wartosc.";
");       
}
/* Koniec pliku */
fputs($fp, "
}");
fclose($fp);
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
				<form class="form" action="personalization" method="POST">
					<ul class="inputs">
						<li>Kolor menu <input type="text" name="menu-color" value="#"></li>
						<li>Kolor przycisku menu <input type="text" name="menu-button-color" value="#"></li>
						<li>Kolor przycisku menu (po hajechaniu) <input type="text" name="menu-button-color2" value="#"></li>
						<li>Kolor elementu menu <input type="text" name="menu-item-color" value="#"></li>
						<li>Kolor elementu menu (po najechaniu) <input type="text" name="menu-item-color2" value="#"></li>
						<li>Kolor tekstu <input type="text" name="text-color" value="#"></li>
						<li>Kolor artykółu <input type="text" name="articule-color" value="#"></li>
						<li>Kolor zaznaczonego tekstu <input type="text" name="copy-text-color" value="#"></li>
						<li>Kolor tła zaznaczonego tekstu <input type="text" name="copy-background-color" value="#"></li>
						<li>Linie ("border") <input type="text" name="lines" value="#"></li>
						<li>Kolor stopki <input type="text" name="footer-color" value="#"></li>
						<li>Kolor tła strony <input type="text" name="background" value="#fff"></li>
						<li>Kolor tła strony <input type="text" name="main-background" value="#efefef"></li>
						<li><input type="color" class="input-color"><div class="color-div"> Wybierz kolor </div></li>
					</ul>
					<select name="Color">
						<option value="-1">wybierz kolor</option>
						<option value="blue">niebieski</option>
						<option value="green">zielony</option>
						<option value="brown">brązowy</option>
						<option value="black">czarny</option>
					</select>
					<ul class="checkboxs">
						<li><input type="checkbox" name="bottom" checked><span>Bottom</span></li>
						<li><input type="checkbox" name="footer" checked><span>Stopka</span></li>
					</ul>
					<ul class="ranges">
						<li><span class="count">5</span> <input type="range" min="0" max="25" value="5" name="text-size"><span> Wielość czcionki</span></li><br/>
						<li><span class="count">5</span> <input type="range" min="0" max="25" value="5" name="menu-text-size"><span> Wielość czcionki w menu</span></li>
					</ul>
					<input type="submit" value="SAVE">
				</form>
			</section>
		</main>
	</body>
</html>