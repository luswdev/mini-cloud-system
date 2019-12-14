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
			<h1 class="cloud-title animate-down">Who?</h1>
		</a>
	</header>
	<div class="main animate-up">
		<div class="main-inner">

			
			<form class="login-block" role="form" action="/do_login.php" method='post' autocomplete="off" >
				<div class="account-box">
					<input type="text" placeholder="Account" name="account" autofocus="autofocus" autocapitalize="none" autocomplete="new-password">
				</div>
				<div class="password-box">
					<input type="password" placeholder="Password" name="password" autocomplete="new-password">
				</div>
				<div class="submit-box">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					<input type="submit" class="login" value="sign in" name="login"></input>
				</div>
			</form>
		</div>

		<?php include_once('_partial/footer.php'); ?>
	</div>
</body>
</html>
