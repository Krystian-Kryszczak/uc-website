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
		<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
		<script src="http://127.0.0.1/assets/javascript/button.js" type="text/javascript" defer></script>
	</head>
	<body>
		<?php include(E."/panel/bars.php");?>
		<main class="main">
			<section class="container full dashboard" style="height: calc(100% - 10vh);">
				<div class="1">
					<div class="guests">
						<h3>Ilość odwiedzin</h3>
						<ul>
							<li>Dziś: 12</li>
							<li>W ciągu miesiąca: 1457</li>
						</ul>
					</div>
					<div class="active-guests">
						<span>Aktułalna ilość gości na stronie: 27</span>
					</div>
					<div class="views">
						<h3>Ilość wyświetlonych artkółów.</h3>
						<ul>
							<li>Dziś: 12</li>
							<li>W ciągu miesiąca: 1457</li>
						</ul>
					</div>
				</div>
				<div class="2">
					<div class="articules">
						<h3>Ostatnie artykóły</h3>
						<ul>
							<li>
								<div>
									<h5>"Jak stworzyć stronę internetową"</h5><i class="fas fa-user-slash"></i> <i class="far fa-eye"></i> <i class="far fa-times-circle"></i>
								</div>
							</li>
							<li>
								<div>
									<h5>"Jak otworzyć sklep internetowy".</h5><i class="fas fa-user-slash"></i> <i class="far fa-eye"></i> <i class="far fa-times-circle"></i>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="3">
					<div class="notes">
						<h3>Notatki</h3>
						<a href="#">Add</a>
						<ol>
							<li><span>Hello World!</span><button> View more </button><button> Remove </button></li>
							<li><span>Dziś jedź do stomatologa</span><button> View more </button><button> Remove </button></li>
							<li><span>Jutro są Walętynki.</span><button> View more </button><button> Remove </button></li>
							<li><span>Zeszłoroczny backfriday wyszedł naprawdę słąbo.</span><button> View more </button><button> Remove </button></li>
							<li><span>Zadzwoń do Pana Edwarda.</span><button> View more </button><button> Remove </button></li>
						</ol>
					</div>
					<div class="permissions">
						<h3>Uprawnienia</h3>
						<form action="#" method="POST">
							<table>
								<thead>
									<tr>
										<th>X_Krychu_X</th>
										<th>Admin123</th>
										<th>Mod1337</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="hidden" value="Mod1337"> <input type="radio" name="X_Krychu_X" value="Mod" checked> <span style="font-weight: 600; text-decoration: underline;">Root</span></td>
										<td><input type="radio" name="Admin123" value="Admin"> Root</td>
										<td><input type="radio" name="Mod1337" value="Root"> Root</td>
									</tr>
									<tr>
										<td><input type="hidden" value="Admin123"> <input type="radio" name="X_Krychu_X" value="Mod"> Admin</td>
										<td><input type="radio" name="Admin123" value="Admin" checked> <span style="font-weight: 600; text-decoration: underline;">Admin</span></td>
										<td><input type="radio" name="Mod1337" value="Root"> Admin</td>
									</tr>
									<tr>
										<td><input type="hidden" value="X_Krychu_X"><input type="radio" name="X_Krychu_X" value="Mod"> Moderator</td>
										<td><input type="radio" name="Admin123" value="Admin"> Moderator</td>
										<td><input type="radio" name="Mod1337" value="Root" checked> <span style="font-weight: 600; text-decoration: underline;">Moderator</span></td>
									</tr>
								</tbody>
							</table>
							<input type="submit" value="Save">
						</form>
					</div>
				</div>
			</section>
		</main>
	</body>
</html>