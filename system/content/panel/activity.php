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
				<div class="activity">
					<ol>
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
$limit = 15;

if(isset($_GET['page']))
{
	$p = $_GET['page'];
	$start=($p - 1)*$limit;
}
else
{
	$p=1;
}

$sql = "SELECT id,content,datetime FROM activity ORDER BY datetime DESC LIMIT $start, $limit";
$result = mysqli_query($connect, $sql);

$total=mysqli_num_rows(mysqli_query($connect, "SELECT id FROM activity"));
$count = ceil($total/$limit);

if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_assoc($result))
	{
        echo '<li><p>'.date_format(date_create($row["datetime"]), 'd/m/Y H:i:s').'</p><span>'.$row["content"].'</span><a href="x?target=activity&w=id&delete='.$row["id"].'&back=activity"><i class="far fa-times-circle"></i></a></li>';
    }
}
else
{
	if ($p!=1)
	{
		header("Location: activity?page=$count");
	}
	else
	{
		echo "Brak zapisów.";
	}
}
?>
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
mysqli_close($connect); 
?>
						</ul>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>