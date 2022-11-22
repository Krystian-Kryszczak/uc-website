<?php
session_start();
if (!isset($_SESSION['logged']))
{
	header('Location: login');
	exit();
}
else
{
	require(CONFIG);
	
	$target = $_GET["target"];
	$w = $_GET["w"];
	$delete = $_GET["delete"];
	$back = $_GET["back"];
	
	// Create connection
	$connect = mysqli_connect($host, $db_user, $db_password, $db_name);
	// Check connection
	if (!$connect)
	{
		die("Connection failed: " . mysqli_connect_error());
	}

	// sql to delete a record
	$sql = "DELETE FROM $target WHERE $w=$delete";

	if (mysqli_query($connect, $sql))
	{
		echo "Record deleted successfully";
	}
	else
	{
		echo "Error deleting record: " . mysqli_error($connect);
	}

	mysqli_close($connect);
	header("Location: $back");
	exit();
}
?>