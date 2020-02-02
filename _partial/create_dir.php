<?php
ob_start();
session_start();

$config = json_decode(file_get_contents("../_config.json"));

$dir_name = $_POST["dir_name"];
$pwd = $_SESSION["pwd"];
$target = $config->upload_root.$_SESSION["pwd"]."/".$dir_name;

if (mkdir($target,0777))
    $_SESSION["mkdir_result"] = "success";
else
    $_SESSION["mkdir_result"] = "failed";

if ($_SESSION["pwd"]=="/")
    $_SESSION["pwd"] = $dir_name;
else
    $_SESSION["pwd"] = $_SESSION["pwd"]."/".$dir_name;

 header("Location:/render.php");

?>