<?php
session_start();
if (!isset($_SESSION['logged']))
{
	header('Location: login');
	exit();
}
else if(isset($_POST['content']))
{
	require(CONFIG);
	$connect = mysqli_connect($host, $db_user, $db_password, $db_name);
	$id = mysqli_fetch_assoc(mysqli_query($connect, "SELECT id FROM activity ORDER BY id DESC LIMIT 1"))["id"]+1;
	$content = $_POST['content'];
	$date = date('Y-m-d H:i:s');

	if (!$connect)
	{ 
		die("Connection failed: " . mysqli_connect_error()); 
	}

	$sql = "INSERT INTO activity VALUES( '$id','$content','$date' );"; 
		
	if (isset($content))
	{ 
		mysqli_query($connect, $sql);
	}

	mysqli_close($connect);
	header('Location: activity.php');
	exit();
}
?>