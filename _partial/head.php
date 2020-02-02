<head>
	<title>
		<?php
    	$config = json_decode(file_get_contents('_config.json'));

		echo $config->title;
		?>
	</title>
	<meta name="theme-color" content="#000">
	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<link rel="icon" type="image/png" href="_asserts/favicon-32x32.png">

    <?php
		if ($asserts = scandir('_asserts/css'))
			foreach ($asserts as $css)
				if (preg_match("/[a-zA-Z0-9]?\.css$/", $css))
					echo "<link rel='stylesheet' type='text/css' href='_asserts/css/$css'>";
    ?>
    
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <?php
		if ($asserts = scandir('_asserts/js'))
			foreach ($asserts as $js)
				if ($js != '.' && $js != '..')
					echo "<script src='_asserts/js/$js'></script>";
			
	?>
</head>
