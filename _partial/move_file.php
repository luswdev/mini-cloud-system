<?php
ob_start();
session_start();

$target = $_POST['target'];
$destination = $_POST['destination'];

$config = json_decode(file_get_contents('../_config.json'));

if ($_SESSION['pwd'] != '/')
    $target_dir = $config->upload_root.$_SESSION['pwd'].'/';
else 
    $target_dir = $config->upload_root.$_SESSION['pwd'];

$target_file = $target_dir.$target;

if (isset($_POST['back'])){
    $new_location = $target_dir;
    $back_nest = $_POST['back'];

    if ($back_nest != -1) {
        while ($back_nest--) {
            $new_location .= '../';
        }
    }
    else {
        $new_location = $config->upload_root;
    }
    
    echo $new_location;
    $new_location .= $target;
}
else {
    $new_location = $target_dir.$destination.'/'.$target;
}

if (rename($target_file, $new_location))    
    $_SESSION['move_result'] = 'success';
else
    $_SESSION['move_result'] = 'failed';

?>