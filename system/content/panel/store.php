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
		<?php $option_bar = "<button>+ Dodaj produkt / usługe</button>... (Dopisać kolejne opcje w zależności od tego czy są one możliwe do wykonania)"; include(E."/panel/bars.php");?>
		<main class="main">
			<section class="container full pages" style="height: calc(100% - 10vh); overflow-y: scroll;">
				<h3>Sklep</h3>
				<ul>
<?php
require(CONFIG);
// Create connection
$connect = mysqli_connect($host, $db_user, $db_password, $db_name);
// Check connection
if (!$connect)
{
    die("Connection failed: " . mysqli_connect_error());
}

$start = 0;
$limit = 20;

if(isset($_GET['page']))
{
	$p = $_GET['page'];
	$start=($p - 1)*$limit;
}
else
{
	$p=1;
}

$sql = "SELECT id,name,image,description,amount,type FROM store ORDER BY id DESC LIMIT $start, $limit";
$result = mysqli_query($connect, $sql);

$total=mysqli_num_rows(mysqli_query($connect, "SELECT id FROM store"));
$count = ceil($total/$limit);

if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
	{
        echo '<li><h3>'.$row["name"].'</h3><img src="'.$row["image"].'"><span>'.$row["description"].'</span><span>'.$row["amount"].'</span></li>';
    }
}
else
{
	if ($p!=1)
	{
		header("Location: store?page=1");
	}
	else
	{
		echo "Brak zapisów.";
	}
}







/*

if (// zapytanie daje jakiś rezultaty (ilośc wierszy jest inna od 0))
{
	for($i = 1; $i <= $pages_c; $i++)
	{
		echo
'					<li>
						<div class="product">
							// Nazwa
							// Opis
							// Dostępność / Aktułalność / Ilość w magazynie (W zależności o tego czy to produkt czy usługa)
							// Usługa czy produkt
							// Ilość
							// Buy
						</div>
					</li>';
	}
}
else
{
echo
"					<li>
						Brak produktów / usług!
					</li>";
}
*/


/*
					</ol>
					<div class="page-list">
						<ul>
<?php
if ($p > 1)
{
	echo '<li><a href=?page='.($p-1).'><i class="fas fa-angle-left"></i></a></li>';
}
for ($i=1; $i <= $count; $i++)
{
	$active = $i == $p ? ' class="active"' : '';
	echo "<li><a href=?page=$i$active>$i</a></li>";
}
if ($p != $count)
{
	echo '<li><a href=?page='.($p+1).'><i class="fas fa-angle-right"></i></a></li>';
}
*/
mysqli_close($connect); 
?>
					<li>
						<div class="product">
							
						</div>
					</li>
				</ul>
			</section>
		</main>
	</body>
</html>