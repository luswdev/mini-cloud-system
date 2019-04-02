<?php
ob_start();
session_start();

if ($_SESSION['valid'])
	header("Location:/");
?>

<html>
<head>
	<?php include_once('_partial/head.php'); ?>
</head>
<body>

	<?php include_once('_partial/info_block.php'); ?>

	<header>
		<a href='/'>
			<h1 class="cloud-title animate-down">OMU</h1>
		</a>
	</header>
	<div class="main animate-up">
		<div class="main-inner">

			
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

		<?php include_once('_partial/footer.php'); ?>
	</div>
</body>
</html>
