<?php
ob_start();
session_start();

if (!$_SESSION['valid']){
	$_SESSION['state']='guest';
	echo "<script>window.location.assign('/logout.php');</script>";
}

?>
<html>
<head>
	<?php include_once('_partial/head.php'); ?>
</head>
<body>

	<?php include_once('_partial/info_block.php'); ?>
	<?php include_once('_partial/header.php'); ?>

	<div class="main">
		
		<?php include_once('_widgets/download_box.php'); ?>
		<?php include_once('_widgets/delete_box.php'); ?>
		<?php include_once('_widgets/upload_box.php'); ?>

		<div class="main-inner animate-up file-page">

			<div class="lists-pwd">
				<button class="upload-btn">
					<i class="fas fa-cloud-upload-alt"></i>
				</button>
				<span class="pwd">
					<a href="/"><i class="fas fa-home"></i></a>&nbsp
					<?php
					$pwd = $_SESSION['pwd']; 
					$pwd_arr = explode('/',$pwd);
					$curr_path = '';
					foreach ($pwd_arr as $path){
						if ($curr_path != "")
							$curr_path.='/';
						$curr_path.=$path;
						echo " > <a onclick='jump_path(`$curr_path`)'>$path</a>";
					}
					echo "</span>";
					?>	

					
							<?php
								$path = $_SESSION['pwd'];
								$path_arr = explode("/",$path);
								$back = str_replace('/'.end($path_arr),'',$path);
								if ($back!=$path)
									echo "<button class='back-btn' onclick='jump_path(`$back`)'>";
								else 
									echo "<button class='back-btn' onclick='javascript:window.location=`/`'>"
							?>
						<i class="fas fa-level-up-alt"></i>
					</button>
					<button class="logout-btn" onclick="javascript:window.location='logout.php'">
						<i class="fas fa-sign-out-alt"></i>
					</button>
			</div>

			<div class="container">
				<table class='file-lists'>
					<thead>
						<tr class='animate-up'>
							<th class='type'>
								<span class="debug debug-type">Type</span>
							</th>
							<th class='name'>
								<span class="debug" onclick='sort_table(1)'>Name</span>
								<i class="fas fa-sort-down"></i>
								<i class="fas fa-sort-up"></i>
							</th>
							<th class='download'>
								<span class="debug debug-download"></span>
							</th>
							<th class='th-time'>
								<span class="debug" onclick='sort_table(3)'>Time</span>
								<i class="fas fa-sort-down"></i>
								<i class="fas fa-sort-up"></i>
							</th>
						</tr>
					</thead>
					</tbody>
					<?php
					$pwd = $_SESSION['pwd'];
					if ($handle = scandir($pwd)) {
						foreach ($handle as $file) {
							if ($file[0] != "." && $file[0]!="_") {
								echo "<tr class='animate-up'>";

								if (is_dir($pwd.'/'.$file)){
									echo "<td class='icon icon-folder'><i class='fas fa-folder'></i></td>";
									echo "<td class='name'><a onclick='jump_path(`$pwd/$file`)'>$file</a></td>";
									echo "<td class='download'></td>";
								}
								else {
									echo "<td class='icon icon-file'><i class='fas fa-file-alt'></i></td>";
									echo "<td class='name'><a href='$pwd/$file'>$file</a></td>";
									echo "<td class='download' onclick='open_box(`$pwd/$file`)'><i class='fas fa-cloud-download-alt'></i></td>";
								}
								$ftime=date("Y/m/d",filemtime($pwd.'/'.$file));
								echo "<td class='time'><span class='file-meta'>$ftime</span></td></tr>";
							}	
						}
					}	
					?>
					</tbody>
				</table>
			</div>
		</div>

		<?php include_once('_partial/footer.php'); ?>				
	</div>
</body>
</html>
