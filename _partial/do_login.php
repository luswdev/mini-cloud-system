<?php
ob_start();
session_start();

$config = json_decode(file_get_contents('../_config.json'));
?>

<html>
    <?php include_once('../_partial/head.php'); ?>
<body>
	<div class="logout-text">
		<div class="loading">
			Hi
			<div class="obj"></div>
			<div class="obj"></div>
			<div class="obj"></div>
			<div class="obj"></div>
			<div class="obj"></div>
			<div class="obj"></div>
			<div class="obj"></div>
			<div class="obj"></div>
    	</div>
	</div>

	<?php
	include_once('../_exec/db.php');

	$sql = "SELECT passwd FROM users_list WHERE account = ?";
	$stmt = $mysqli->prepare($sql);
	$stmt->bind_param('s',$_POST['account']);
	$stmt->execute();
	$stmt->bind_result($passwd);
	$stmt->fetch();
	$stmt->close();

	if (!empty($_SERVER["HTTP_CLIENT_IP"])){
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}else{
		$ip = $_SERVER["REMOTE_ADDR"];
	}

	$_SESSION['ip'] = $ip;
    $_SESSION['account'] = $_POST['account'];

	if ( $passwd == hash('sha256', $_POST['password']) && $_POST['password']!='' ){

		$_SESSION['valid'] = true;
		$_SESSION['timeout'] = time();
		$_SESSION['state'] = 'success';
		

		$insert_sql = "INSERT INTO `login_log` ( account, login_time, login_ip) VALUES (?,?,?)";
		$stmt = $mysqli->prepare($insert_sql);
		$stmt->bind_param('sss', $_POST['account'], date("Y-n-d H:i:s"), $ip);
		$stmt->execute();

		$find_id = "SELECT LAST_INSERT_ID()";
		$stmt = $mysqli->prepare($find_id);
		$stmt->execute();
		$stmt->bind_result($id);
		$stmt->fetch();
		$stmt->close();

		$_SESSION['login_id'] = $id;
	}
	else {
		$_SESSION['valid'] = false;
		$_SESSION['state'] = 'bad';

		$insert_sql = "INSERT INTO `login_error_log` ( trying_account, trying_time, trying_ip) VALUES (?,?,?)";
		$stmt = $mysqli->prepare($insert_sql);
		$stmt->bind_param('sss', $_POST['account'], date("Y-n-d H:i:s"), $ip);
		$stmt->execute();
        $stmt->close();
        
		header("Location:/login.php");
	}
	?>
</body>
</html>
