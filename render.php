<?php
ob_start();
session_start();

if (!$_SESSION['valid']){
	$_SESSION['state']='guest';
	header("Location:/login.php");
}

$_SESSION['pwd']= $_GET['links']; 
?>
<html>
<head>
	<title>OMU Cloud</title>
	<meta name="theme-color" content="#37474F">
 	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="assert/main.css?ver=122">
	<link rel="stylesheet" type="text/css" href="assert/helper.css?ver=122">
	<link rel="stylesheet" type="text/css" href="assert/outline.css?ver=122">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans|Germania+One" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">	
</head>
<body>

	<?php include_once('info_block.php'); ?>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="assert/effect.js"></script>

	<header>
		<form class="search-box" action='search.php' method='post'>
			<div class="search-box-container">
				<input type="text" name="search_file" id="search-file" class="search-input" placeholder="Search file">
				<button class="search-go"><i class="fas fa-search"></i></button>
			</div>
		</form>
	</header>

	<div class="main">
		<div class="download-check-box">
			<h4></h4>
			<div class="download-check-btn-box">
				<button class="check-btn"><a onclick="close_box()">Yes</a></button>
				<button class="check-btn" onclick="close_box()">No</button>
			</div>
		</div>

		<div class="delete-check-box">
			<h4></h4>
			<div class="delete-check-btn-box">
				<button class="check-btn"><a onclick="close_box()">Yes</a></button>
				<button class="check-btn" onclick="close_box()">No</button>
			</div>
		</div>

		<div class="file-upload-box">
			<form method="post" action="/upload.php" enctype="multipart/form-data">
				<h4>Select file to upload:</h4>
				<div class="file-location-box">
					<span class="file-location"></span>
				</div>
				<label class="file-upload-btn">
					<input type="file" name="fileToUpload" id="fileToUpload" style="display:none;">
					<span>Choose</span> 
				</label>
				<div>
					<button class="ready-upload-btn" type="submit" name="submit">Upload</button>
					<button class="close-upload-btn">Cancel</button>
				</div>
			</form>
		</div>

		<div class="main-inner">

			<div class="lists-pwd animate-up">
				<button class="upload-btn">
					<i class="fas fa-cloud-upload-alt"></i>
				</button>
				<span class="pwd">
					<?php
					$pwd = $_GET['links']; 
					echo "~/".$pwd;
					echo "</span>";
					?>	
					<button class="back-btn">
						<i class="fas fa-level-up-alt"></i>
					</button>
					<button class="logout-btn">
						<i class="fas fa-sign-out-alt"></i>
					</button>
			</div>

			<div class="container">
				<table class='animate-up file-lists'>
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
					$pwd = $_GET['links'];
					if ($handle = scandir($pwd)) {
						foreach ($handle as $key => $file) {
							if ($file != "." && $file != ".." && $file[0]!=".") {
								echo "<tr class='animate-up'>";
								if (preg_match("/[cChH]$/", $file))
										$icon='far fa-file-code';
									else if (preg_match("/txt$/", $file))
										$icon='far fa-file-alt';
									else if (preg_match("/git$/", $file))
										$icon='fab fa-git-square';
									else if (preg_match("/md$/", $file))
										$icon='fab fa-markdown';
									else
										$icon='fas fa-file';

								if (is_dir($pwd.'/'.$file)){
									echo "<td class='icon icon-folder'><i class='fas fa-folder'></i></td>";
									echo "<td class='name'><a href='/render.php?links=$pwd/$file'>$file</a></td>";
									echo "<td class='download'></td>";
								}
								else {
									echo "<td class='icon icon-file'><i class='$icon'></i></td>";
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
		<footer>
			&copy; 2019 OMU Skywalker
		</footer>
	</div>
</body>
</html>
