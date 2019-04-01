<?php
ob_start();
session_start();

if (!$_SESSION['valid']){
	$_SESSION['state']='guest';
	header("Location:/login.php");
}
else{
	unset($_SESSION['account']);
	unset($_SESSION['password']);
	unset($_SESSION['valid']);

	$_SESSION['state']='logout';

	$mysqli = new mysqli('localhost', 'callumlu', 'callum1996', 'cloud_db');
	$sql = "UPDATE `login_log` SET `logout_time` = ? WHERE `login_id` = ? ";
	$stmt = $mysqli->prepare($sql);
	$times=date("Y-n-d H:i:s");
	$stmt->bind_param('si', $times ,$_SESSION['login_id']);
	$stmt->execute();
	$stmt->close();

	unset($_SESSION['login_id']);
	unset($_SESSION['pwd']);

}

header('Refresh: 2; URL=/login.php')

?>
<html>
<head>
	<title>Bye Bye</title>
	<meta name="theme-color" content="#37474F">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="assert/main.css">
	<link rel="stylesheet" type="text/css" href="assert/helper.css">
	<link rel="stylesheet" type="text/css" href="assert/outline.css">
	<link href="https://fonts.googleapis.com/css?family=Germania+One|Open+Sans" rel="stylesheet">
</head>
<body>
	<div class="logout-text">
		Login out
		<span id="dot">.</span>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="assert/effect.js"></script>
</body>
</html>
