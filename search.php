<?php
ob_start();
session_start();

if (!$_SESSION['valid']){
	$_SESSION['state']='guest';
	header("Location:/login.php");
}

?>
<html>
<head>
	<title>OMU Cloud</title>
	<meta name="theme-color" content="#37474F">
	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="assert/main.css?ver=123">	
	<link rel="stylesheet" type="text/css" href="assert/helper.css">
	<link rel="stylesheet" type="text/css" href="assert/outline.css?ver=12">
	<link href="https://fonts.googleapis.com/css?family=Germania+One|Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">	
</head>
<body >

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="assert/effect.js"></script>

	<header>
		<form class="search-box" action='search.php' method='post'>
			<div class="search-box-container">
				<input type="text" name="search_file" id="search-file" class="search-input">
				<button class="search-go" type='submit'><i class="fas fa-search"></i></button>
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

		<div class="main-inner">
		
			<div class="lists-pwd animate-up">
				<span class="pwd">Searching '<span class="match"><?php echo $_POST['search_file'] ?></span>', total <span class="result-cnt"></span> result(s).</span>

				<button class="home-btn">
					<i class="fas fa-home"></i>
				</button>
				<button class="search-back-btn">
					<i class="fas fa-level-up-alt"></i>
				</button>
				<script>
					$('.search-back-btn').click( function(){
						var pwd = '<?php echo $_SESSION['pwd'] ?>';
						if (pwd == '/'){	
							window.location.href = '/';
						}
						else {
							window.location.href = '/render.php?links='+pwd;
						}
						
					});
				</script>
                
				<button class="logout-btn">
					<i class="fas fa-sign-out-alt"></i>
				</button>
			</div>
			<div class="container">
				<table class='animate-up file-lists '>
					<thead>
						<tr class='animate-up'>
							<th class='type'>
								<span class="debug debug-type">Type</span>
							</th>
							<th class='name' >
								<span class="debug" onclick='sort_table(1)'>Name</span>
								<i class="fas fa-sort-up"></i>
								<i class="fas fa-sort-down"></i>
							</th>
							<th class='download'>
								<span class="debug debug-download"></span>
							</th>
							<th class='th-time'>
								<span class="debug" onclick='sort_table(3)'>Time</span>
								<i class="fas fa-sort-up"></i>
								<i class="fas fa-sort-down"></i>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						
						searching_file('.',$_POST['search_file']);
						
                        function searching_file($target_dir, $targer_file){
                            if ($handle = scandir($target_dir)) {
                            	foreach ($handle as $key => $file)  {
                                    if (strstr($file, $targer_file)) {
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
        
                                        $notmatchstr = str_replace($targer_file, "<span class='match'>$targer_file</span>", $file);

                                        if (!is_file($target_dir.'/'.$file)){
                                            echo "<td class='icon'><i class='fas fa-folder'></i></td>";
                                            echo "<td class='name'><a href='/render.php?links=$target_dir/$file'>$notmatchstr</a></td>";
                                            echo "<td class='download'></td>";
                                        }
                                        else {
                                            echo "<td class='icon'><i class='$icon'></i></td>";
                                            echo "<td class='name'><a href='$target_dir/$file' target='_blank'>$notmatchstr</span></a></td>";
                                            echo "<td class='download' onclick='open_box(`$target_dir/$file`)'><i class='fas fa-cloud-download-alt'></i></td>";
                                        }
                                        
                                        $ftime=date("Y/m/d",filemtime($target_dir.'/'.$file));
                                        echo "<td class='time'><span class='file-meta'>$ftime</span></td></tr>";
                                    }
                                    if (is_dir($file) && $file != "." && $file != ".." ){
                                        searching_file($target_dir.'/'.$file,$targer_file);
                                    }    
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
