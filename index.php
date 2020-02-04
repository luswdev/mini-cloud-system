<?php
ob_start();
session_start();

if (!isset($_SESSION['valid']) ||  !$_SESSION['valid']){
	$_SESSION['state']='guest';
	header("Location:/login.php");
}
$_SESSION['pwd']= '/'; 

$config = json_decode(file_get_contents('_config.json'));
?>

<html>
	<?php include_once('_partial/head.php'); ?>
<body>
	
	<?php include_once('_partial/info_block.php'); ?>
	<?php include_once('_partial/header.php'); ?>

	<div class="main">

		<?php include_once('_widgets/download_box.php'); ?>
		<?php include_once('_widgets/delete_box.php'); ?>
		<?php include_once('_widgets/create_dir_box.php'); ?>
		<?php include_once('_widgets/upload_box.php'); ?>
		<?php include_once('_widgets/drag_upload_box.php'); ?>

		<div class="main-inner animate-up file-page">
		
			<div class="function-bar">
				<button class="upload-btn pointer">
					<i class="fas fa-cloud-upload-alt"></i>
				</button>
				<span class="pwd">
					<a href="/"><i class="fas fa-home"></i></a>
				</span>

				<button class="logout-btn pointer" onclick="javascript:window.location='_partial/logout.php'">
					<i class="fas fa-sign-out-alt"></i>
				</button>
			</div>

			<?php include_once('_partial/upload_list.php'); ?>

			<div class="container">
				<table class='file-lists'>
					<thead>
						<tr class='animate-up'>
							<th class='type'>
								<span class="table-head table-head-type"></span>
							</th>
							<th class='name' >
								<span class="table-head table-head-name pointer" onclick='sort_table(1)'>Name</span>
								<i class="fas fa-sort-up sort-asc"></i>
								<i class="fas fa-sort-down sort-dec"></i>
							</th>
							<th class='download'>
								<span class="table-head table-head-download"></span>
							</th>
							<th class='th-time'>
								<span class="table-head table-head-time pointer" onclick='sort_table(3)'>Time</span>
								<i class="fas fa-sort-up sort-asc"></i>
								<i class="fas fa-sort-down sort-dec"></i>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($handle = scandir('.')) {
							foreach ($handle as $file)  {
								if ($file[0] != "."  && $file[0]!="_" && !preg_match("/[a-zA-Z0-9]?\.php/", $file)){
									echo "<tr class='animate-up'>";
									if (!is_file($file)){
										echo "<td class='icon icon-folder' value='$file'><i class='fas fa-folder pointer'></i></td>";
										echo "<td class='name pointer'><a onclick='jump_path(`$file`)' draggable='true' class='ftb-dir'>$file</a></td>";
										echo "<td class='download'></td>";
									}
									else {
										echo "<td class='icon icon-file' value='$file'><i class='fas fa-file-alt pointer'></i></td>";
										echo "<td class='name'><a href='$file' target='_blank' draggable='true' class='ftb-file'>$file</a></td>";
										echo "<td class='download' onclick='open_box(`$file`)'><i class='fas fa-cloud-download-alt pointer'></i></td>";
									}
									$ftime=date("Y/m/d",filemtime($file));
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
