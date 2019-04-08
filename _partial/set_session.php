<?php
ob_start();
session_start();

$pwd = $_POST['pwd'];
$_SESSION['pwd'] = $pwd;

echo $pwd;
?>