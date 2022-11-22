<?php
	session_start();
	if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
	{
		header('Location: dashboard');
		exit();
	}
?>
<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
<style>
body
{margin: 0;
padding: 0;
font-family: sans-serif;
background: #2d2d2d;}
form
{width: 300px;
padding: 40px;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
background: #191919;
border: 2px solid #fff;
box-shadow: 0px 0px 15px 2px rgba(0,0,0,.65);
text-align: center;}
form h1
{color: #fff;
text-transform: uppercase;
font-weight: 500;}
form input[type="text"], form input[type="password"]
{border: 0;
background: none;
display: block;
margin: 20px auto;
text-align: center;
border: 2px solid #0064a5;
padding: 14px 10px;
width: 200px;
outline: none;
color: #fff;
border-radius: 24px;
transition: .25s;}
form input[type="text"]:focus,form input[type="password"]:focus
{width: 280px;
border-color: #2ecc71;}
form input[type="submit"]
{border: 0;
background: none;
display: block;
margin: 20px auto;
text-align: center;
border: 2px solid #00a564;
padding: 14px 25px;
outline: none;
color: #fff;
border-radius: 24px;
cursor: pointer;
transition: .25s;}
form input[type="submit"]:hover
{background: #00a564;}
</style>
	</head>
	<body>
		<form action="zaloguj" method="post">
			<h1>Login</h1>
			<input type="text" name="user" placeholder="User"/><br/>
			<input type="password" name="password" placeholder="Password"/>
			<input type="submit" value="Login"/>
		</form>
<?php if(isset($_SESSION['error'])) echo '<script> window.alert(\"'.$_SESSION['error'].'\"); </script>'; ?>
	</body>
</html>