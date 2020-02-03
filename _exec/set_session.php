<?php
ob_start();
session_start();

if (isset($_POST['pwd'])) {
    $pwd = $_POST['pwd'];
    $_SESSION['pwd'] = $pwd;
}

if (isset($_GET['upload_result'])) {
    $upload_result = $_GET['upload_result'];
    $_SESSION['upload_result'] = $upload_result;
}
?>