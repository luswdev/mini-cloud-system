<?php
ob_start();
session_start();

if ($_SESSION['valid'])
	header("Location:/");
?>

<html>
<head>
	<title>OMU Cloud</title>
	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<meta name="theme-color" content="#37474F">
	<link rel="stylesheet" type="text/css" href="assert/main.css?ver=1428">	
	<link rel="stylesheet" type="text/css" href="assert/helper.css?ver=1503">
	<link rel="stylesheet" type="text/css" href="assert/outline.css?ver=1503">
	<link href="https://fonts.googleapis.com/css?family=Germania+One|Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">	
</head>
<body>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="assert/effect.js?ver=11415"></script>

	<header>
		<a href='/'>
			<h1 class="cloud-title animate-down">OMU</h1>
		</a>
	</header>
	<div class="main animate-up">
		<div class="main-inner">
			<div class="login-check">
				<?php
					if ($_SESSION['state']=='bad') {
						echo "
						<div class='bad-info info-block'>
						Incorrect username or password.	
						</div>";
					}
					else if ($_SESSION['state']=='logout'){
						echo "
						<div class='logout-info info-block'>
						Successful logout.	
						</div>";
					}
					else if ($_SESSION['state']=='guest'){
						echo "
						<div class='guest-info info-block'>
						Please login first.	
						</div>";
					}
					unset($_SESSION['state']);
				?>
							
			</div>
			
			<form class="login-block" role="form" action="/do_login.php" method='post'>
				<div class="account-box">
					<i class="fas fa-user"></i>
					<input type="text" placeholder="Account" name="account" autofocus="autofocus" autocapitalize="none" autocomplete="off" >
				</div>
				<div class="password-box">
					<i class="fas fa-lock"></i>
					<input type="password" placeholder="Password" name="password" >
				</div>
				<button class="login" name="login">
					sign in
				</button>
			</form>
		</div>

		<footer>
			&copy; 2019 OMU Skywalker
		</footer>
	</div>
</body>
</html>
