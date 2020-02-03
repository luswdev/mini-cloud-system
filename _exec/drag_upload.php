<?php
ob_start();
//session_start();

$config = json_decode(file_get_contents("../_config.json"));

if ($_POST["pwd"]!="/")
	$target_dir = $config->upload_root.$_POST["pwd"]."/";
else
	$target_dir = $config->upload_root;

$files_cnt = count($_FILES["drag-file"]["tmp_name"]);
$result ="failed";

for ($i = 0; $i < $files_cnt; $i++) {
    $target_file = $target_dir.basename($_FILES["drag-file"]["name"][$i]);
    $uploadOk = 1;

    if (file_exists($target_file)) {
        $uploadOk = 0;
        $result = "exists";
    }
    
    if ($_FILES["drag-file"]["name"][$i] == ""){
        $uploadOk = 0;
        $result = "failed";
    }
    
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["drag-file"]["tmp_name"][$i], $target_file)) {
            $result ="success";
        } else {
            $result = "failed";
        }
    }
}

header("Location:/_exec/set_session.php?upload_result=".$result);
?> 

