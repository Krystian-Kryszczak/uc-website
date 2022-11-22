<?php
session_start();
if (!isset($_SESSION['logged']))
{
	header('Location: login');
	exit();
}

require(CONFIG);

$order_by = "datetime";

$connect = mysqli_connect($host, $db_user, $db_password, $db_name);
if (!$connect)
{
    die("Connection failed: " . mysqli_connect_error());
}

$start = 0;
$limit = 20;

if(isset($_GET["page"]))
{
	$p = $_GET["page"];
	$start=($p - 1)*$limit;
}
else
{
	$p=1;
}

if(!isset($_GET["search"]))
{
	$sql = "SELECT art,title,image FROM articles ORDER BY $order_by DESC LIMIT $start, $limit";
	$total=mysqli_num_rows(mysqli_query($connect, 'SELECT id FROM articles'));
}
else
{
	$sql = 'SELECT art,title,image FROM articles WHERE title LIKE "%'.$_GET["search"].'%" ORDER BY '.$order_by.' DESC LIMIT '.$start.', '.$limit;
	$total=mysqli_num_rows(mysqli_query($connect, 'SELECT id FROM articles WHERE title LIKE "%'.$_GET["search"].'%"')); // pomyśleć na zmianą (sql = mysqli_query($connect, 'SELECT id FROM articles DESC LIMIT 1'))
}

$result = mysqli_query($connect, $sql);
$count = ceil($total/$limit);

if(isset($_GET["modify"], $_GET["art"]))
{
	$zyx = mysqli_query(mysqli_connect($host, $db_user, $db_password, $db_name), 'SELECT art,title,image,content FROM articles WHERE art="'.$_GET["art"].'"');
	$xyz = mysqli_fetch_assoc($zyx);
	$zart = $xyz["art"];
	$ztitle = $xyz["title"];
	$zimage = $xyz["image"];
	$zcontent = $xyz["content"];
}

if(isset($_POST["change"], $_POST["title"], $_POST["image"], $_POST["content"], $_POST["art"])) // Dodać filtry, które będą sprawdzać poprawność przesłanych danych
{
	mysqli_query(mysqli_connect($host, $db_user, $db_password, $db_name), "UPDATE `articles` SET `title` = '".$_POST["title"]."', `image` = '".$_POST["image"]."', `content` = '".$_POST["content"]."' WHERE `articles`.`art` = '".$_POST["art"]."'");
}

if(isset($_POST["title"], $_POST["image"], $_POST['content']) && !isset($_POST["change"]))
{
	$id = mysqli_query($connect, 'SELECT id FROM articles DESC LIMIT 1');
	$content = nl2br($_POST['content']);
	
	if(preg_match("/^{255}$/", $_POST["title"]))
	{
		if(preg_match("/^{255}$/", $_POST['image']))
		{
			mysqli_query($connect, 'INSERT INTO articles (id, art, title, image, content, datetime, autor) VALUES ('.$id.', '.$_POST["art"].', '.$_POST["title"].', '.$_POST["image"].', '.$content.', '.date('Y-m-d H:i:s').'., '.$_POST["autor"].')');
		}
		else
		{
			$errormsg = "Nazwa obrazu jest zbyt długa! (MAX:255)";
		}
	}
	else
	{
		$errormsg = "Tytuł artykółu jest zbyt długi! (MAX:255)";
	}
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
		<?php $option_bar = '<button id="add-article" onClick="show_form();">+ Dodaj artykół</button>'; include(E."/panel/bars.php");?>
		<main class="main">
			<section class="container full" style="height: calc(100% - 10vh);">
				<?php if(isset($_GET["modify"])){echo '<div class="article">';}else{echo '<div class="article hide">';}?>
					<?php if(isset($_GET["modify"])){echo '
					<i class="fas fa-times" id="hide-div" style="cursor: pointer;"></i>
					<form method="POST" action="articles">
						<input id="title" type="text" placeholder="Title" name="title" value="'.$ztitle.'"><br>
						<input id="image" type="text" placeholder="Nazwa obrazu|zdjęcia z rozszerzeniem (np. image.png, photo.jpg)" name="image" value="'.$zimage.'"><br>
						<input type="hidden" name="art" value="'.$zart.'"><br>
						<input type="hidden" name="change" value="true"><br>
						<textarea id="textarea" placeholder="Article" name="content">'.$zcontent.'</textarea><br>
						<span id="chars">Ilość znaków: 0</span>
						<input id="submit" type="submit" value="Send"/>
						<input id="reset" type="reset" value="Usuń zawartość formularza"/>
					</form>';}?>
				</div>
				<ol>
<?php
if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
	{
echo
	'					<li>
						<a href="http://127.0.0.1/article/'.$row['art'].'">
							<img src="http://127.0.0.1/assets/images/'.$row['image'].'">
							<div>
								<h3>'.$row['title'].'</h3>
							</div>
						</a>
						<button id="remove_article" name="'.$row['art'].'" onClick="conf(this.name)">- Usuń artykół</button><br>
						<a id="modify_article" href="articles?modify=true&art='.$row['art'].'">* Modyfikuj artykół</a><br>
						<button id="change_uri" onClick="this.remove(); alert(`Opcję Zmień adres artykółu trzeba stworzyć później`)">* Zmienń adres artykółu</button>
					</li>
';
    }
}
else
{
	if ($p!=1)
	{
		header('Location: articles?'.(isset($_GET["search"]) ? 'search='.$_GET["search"] : ''));
	}
	else
	{
		echo "Brak rezultatów.";
		$count = 1;
	}
}
?>
				</ol>
				<div class="page-list">
					<ul>
<?php
$get = isset($_GET["search"]) ? 'search='.$_GET["search"].'&' : '';
if ($p > 1)
{
	echo
'						<li><a href="?'.$get.'page='.($p-1).'"><i class="fas fa-angle-left"></i></a></li>';
}
for ($i=1; $i <= $count; $i++)
{
	$active = $i == $p ? ' class="active"' : '';
	echo 
'						<li><a href="?'.$get.'page='.$i.'"'.$active.'>'.$i.'</a></li>';
}
if ($p != $count && 5 == 5)
{
	echo
'						<li><a href="?'.$get.'page='.($p+1).'"><i class="fas fa-angle-right"></i></a></li>';
}
mysqli_close($connect);
?>

					</ul>
				</div>
			</section>
		</main>
	</body>
<script src="http://127.0.0.1/assets/javascript/articles.js" type="text/javascript"></script>
</html>