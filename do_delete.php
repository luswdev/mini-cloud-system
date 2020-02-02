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

$result;
if (file_exists($target)) {
    //chmod($target, 0777);

    if (is_dir($target)) {
        system('rm -rf ' . escapeshellarg($target), $retval);
        $result = !$retval;
    }
    else
        $result = unlink($target);
        
    if ($result)    
        $_SESSION['delete_result'] = 'success';
    else
        $_SESSION['delete_result'] = 'failed';
}
else
    $_SESSION['delete_result'] = 'failed';

?>