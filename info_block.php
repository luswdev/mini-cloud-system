<?php

if (isset($_SESSION['state'])) {
	if ($_SESSION['state'] == 'success'){
		unset($_SESSION['state']);
	
		$mysqli = new mysqli('localhost', 'callumlu', 'callum1996', 'cloud_db');
		$sql = "SELECT `login_time` FROM `login_log` WHERE `account` = ? ORDER BY `login_id` desc";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('s',$_SESSION['account']);
		$stmt->execute();
		$stmt->bind_result($times);
		$stmt->fetch();
	
		echo "
		<div class='account-info'>
		<div class='success-info info-block animate-down'>
		Welcome back! ".$_SESSION['account']."<br>".
		"Last visited at ".$times.
		"</div></div>";
    }
}

if (isset($_SESSION['upload_result'])) {
	if ($_SESSION['upload_result'] == 'exists'){
		unset($_SESSION['upload_result']);

		echo "
		<div class='account-info'>
		<div class='exist-info info-block animate-down'>
			Sorry, the file is exist. 
		</div></div>";
	}
	else if ($_SESSION['upload_result'] == 'success'){
		unset($_SESSION['upload_result']);

		echo "
		<div class='account-info'>
		<div class='success-info info-block animate-down'>
			The file is successfully upload.
		</div></div>";
	}
	else if ($_SESSION['upload_result'] == 'failed'){
		unset($_SESSION['upload_result']);

		echo "
		<div class='account-info'>
		<div class='failed-info info-block animate-down'>
			There was a error occur when the file was uploading.
		</div></div>";
	}
}

if (isset($_SESSION['delete_result'])) {
	if ($_SESSION['delete_result'] == 'failed'){
		unset($_SESSION['delete_result']);

		echo "
		<div class='account-info'>
		<div class='failed-info info-block animate-down'>
		There was a error occur when the file was deleting.
		</div></div>";
	}
	else if ($_SESSION['delete_result'] == 'success'){
		unset($_SESSION['delete_result']);

		echo "
		<div class='account-info'>
		<div class='success-info info-block animate-down'>
		The file is successfully delete.
		</div></div>";
    }
}
?>