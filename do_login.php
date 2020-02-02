<?php
ob_start();
session_start();
?>

<html>
	<?php include_once('_partial/head.php'); ?>
<body>
	<div class="logout-text">
		Sign in
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
    $config = json_decode(file_get_contents('_config.json'));

	define('BOT_TOKEN', $config->telegram->token);
	define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');
	define('chatID', $config->telegram->user_id);

	include_once('_partial/db.php');

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
		
		$reply  = "💀`Sign in WARNING`💀".'%0A'.'%0A'.
				"Someone sign in successfully, is you?🤔🤔".'%0A'.'%0A'."---".'%0A'.
				"🖥️ *IP:* `".$ip."`".'%0A'.
				"💩 *User:* _".$_POST['account']."_".'%0A'.
				"👀 [See more detail](https://file.haterain.app/phpmyadmin)";

		$sendto = API_URL."sendmessage?chat_id=".chatID."&text=".$reply."&parse_mode=markdown";
		file_get_contents($sendto);

		header("Location:/");
	}
	else {
		$_SESSION['valid'] = false;
		$_SESSION['state'] = 'bad';

		$insert_sql = "INSERT INTO `login_error_log` ( trying_account, trying_time, trying_ip) VALUES (?,?,?)";
		$stmt = $mysqli->prepare($insert_sql);
		$stmt->bind_param('sss', $_POST['account'], date("Y-n-d H:i:s"), $ip);
		$stmt->execute();
		$stmt->close();
		
		$reply  = "😈`Attack WARNING`😈".'%0A'.'%0A'.
				"Someone trying to sign in, but failed.".'%0A'.
				"HA!HA!🤣🤣".'%0A'.'%0A'."---".'%0A'.
				"🖥️ *IP:* `".$ip."`".'%0A'.
				"💩 *User:* _".$_POST['account']."_".'%0A'.
				"👀 [See more detail](https://file.haterain.app/phpmyadmin)";

		$sendto = API_URL."sendmessage?chat_id=".chatID."&text=".$reply."&parse_mode=markdown";
		file_get_contents($sendto);

		header("Location:/login.php");
	}
	?>
</body>
</html>
