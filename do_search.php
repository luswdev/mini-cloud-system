<?php
ob_start();
session_start();

if (!isset($_SESSION["valid"])) {
	$_SESSION["state"]="guest";
	header("Location:/_partial/logout.php");
}

$pwd = $_SESSION["pwd"];

$config = json_decode(file_get_contents("_config.json"));
?>

<html>
	<?php include_once("_partial/head.php"); ?>
<body>

	<?php include_once("_partial/header.php"); ?>

	<div class="main">
		
		<?php include_once("_widgets/download_box.php"); ?>

		<div class="main-inner animate-up file-page">
		
			<div class="function-bar">
				<button class="home-btn pointer" onclick="javascript:window.location='/'">
					<i class="fas fa-home"></i>
				</button>

				<span class="pwd">
					Searching "<span class="match"><?php echo $_POST["search_file"] ?></span>", total <span class="result-cnt"></span> result(s).
				</span>
				
				<button class="search-back-btn pointer">
					<i class="fas fa-level-up-alt"></i>
				</button>
				
				<script>
					$(".search-back-btn").click( function(){
						var pwd = "<?php echo $pwd ?>";
						if (pwd == "/"){	
							window.location = "/";
						}
						else {
							window.location = "/render.php";
						}
						
					});
				</script>
                
				<button class="logout-btn pointer" onclick="javascript:window.location="/_partial/logout.php">
					<i class="fas fa-sign-out-alt"></i>
				</button>
			</div>
			<div class="container">
				<table class="file-lists">
					<thead>
						<tr class="animate-up">
							<th class="type">
								<span class="table-head table-head-type"></span>
							</th>
							<th class="name" >
								<span class="table-head table-head-name pointer" onclick="sort_table(1)">Name</span>
								<i class="fas fa-sort-up sort-asc"></i>
								<i class="fas fa-sort-down sort-dec"></i>
							</th>
							<th class="th-path">
								<span class="table-head table-head-path pointer" onclick="sort_table(2)">Path</span>
								<i class="fas fa-sort-up sort-asc"></i>
								<i class="fas fa-sort-down sort-dec"></i>
							</th>
							<th class="download">
								<span class="table-head table-head-download"></span>
							</th>
							<th class="th-time">
								<span class="table-head table-head-time pointer" onclick="sort_table(4)">Time</span>
								<i class="fas fa-sort-up sort-asc"></i>
                                <i class="fas fa-sort-down sort-dec
                                "></i>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						
						searching_file(".",$_POST["search_file"]);
						
                        function searching_file($target_dir, $targer_file){
                            if ($handle = scandir($target_dir)) {
								$dir = str_replace(".","",$target_dir);
								$dir_p = substr($dir,1);
                            	foreach ($handle as $file)  {
                                    if (strstr($file, $targer_file) && $file[0]!="." && $file[0] !="_" && !($target_dir == "." && preg_match("/[a-zA-Z0-9]?\.php/", $file))) {
										echo '<tr class="animate-up">';
        
                                        $notmatchstr = str_replace($targer_file, '<span class="match">'.$targer_file.'</span>', $file);

                                        if (!is_file($target_dir."/".$file)){
                                            echo '<td class="icon icon-folder"><i class="fas fa-folder pointer"></i></td>';
											echo '<td class="name"><a href="/render.php?links=.'.$target_dir.'/'.$file.'">'.$notmatchstr.'</a></td>';
											echo '<td class="path"><a onclick="jump_path(`'.$dir_p.'/'.$file.'`)">~'.$dir.'/'.$file.'</a></td>';
                                            echo '<td class="download"></td>';
                                        }
                                        else {
                                            echo '<td class="icon icon-file"><i class="fas fa-file-alt pointer"></i></td>';
                                            echo '<td class="name"><a href="'.$target_dir.'/'.$file.'" target="_blank">'.$notmatchstr.'</span></a></td>';
											echo '<td class="path"><a onclick="jump_path(`'.$dir_p.'`)">~'.$dir.'</a></td>';
                                            echo '<td class="download" onclick="open_box(`'.$target_dir.'/'.$file.'`)"><i class="fas fa-cloud-download-alt pointer"></i></td>';
                                        }
                                        
                                        $ftime=date("Y/m/d",filemtime($target_dir."/".$file));
                                        echo '<td class="time"><span class="file-meta">'.$ftime.'</span></td></tr>';
                                    }
                                    if (is_dir($file) && $file[0] != "." && $file[0] != "_" ){
                                        searching_file($target_dir."/".$file,$targer_file);
                                    }    
                                }
                            }
                        }
                        ?>
					</tbody>
				</table>
			</div>
		</div>

		<?php include_once("_partial/footer.php"); ?>				
	</div>
</body>
</html>
