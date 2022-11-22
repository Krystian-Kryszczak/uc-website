<?php
	session_start();
	
	if ((!isset($_POST['user'])) || (!isset($_POST['password'])))
	{
		header('Location: /login');
		exit();
	}

	// require "../../config/config.php";
	$host = "localhost"; // Nazwa hosta
	$db_user = "root"; // Nazwa użytkownika
	$db_password = ""; // Haslo do bazy
	$db_name = "impulseengine"; // Nazwa bazy 
	$table = "users"; // Nazwa tabeli
	

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($connect->connect_errno!=0)
	{
		echo "Error: ".$connect->connect_errno;
	}
	else
	{
		$user = $_POST['user'];
		$password = $_POST['password'];
		
		$user = htmlentities($user, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
	
		if ($result = @$connect->query(
		sprintf("SELECT * FROM $table WHERE user='%s' AND password='%s'",
		mysqli_real_escape_string($connect,$user),
		mysqli_real_escape_string($connect,$password))))
		{
			$users = $result->num_rows;
			if($users>0)
			{
				$_SESSION['logged'] = true;
				
				$row = $result->fetch_assoc();
				$_SESSION['id'] = $row['id'];
				$_SESSION['user'] = $row['user'];
				
				unset($_SESSION['error']);
				$result->free_result();
				header('Location: dashboard');
				
			}else{
				
				$_SESSION['error'] = '<span style="color:red">Nieprawidłową nazwe użytkownika lub hasło!</span>';
				header('Location: login');
			}
		}
		$connect->close();
	}
?>