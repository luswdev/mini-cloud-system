<?php
ob_start();
session_start();

$config = json_decode(file_get_contents('_config.json'));

$file =  $_POST['file'];
$file = urldecode($file);


$target=$config->upload_root;

if ($_SESSION['pwd']!='/')
    $target = $target.$_SESSION['pwd'].'/';
$target.=$file;

echo $target;

if (file_exists($target)) {
    if (is_dir($target))
        rmdir($target);
    else
        unlink($target);
        
    $_SESSION['delete_result'] = 'success';
}
else
    $_SESSION['delete_result'] = 'failed';

?>