<head>
	<title>
		<?php
    	$config = json_decode(file_get_contents('_config.json'));

		echo $config->title;
		?>
	</title>
	<meta name="theme-color" content="#F3E5F5">
	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<link rel="icon" type="image/png" href="_asserts/favicon.png">

	<?php
		if ($asserts = scandir('_asserts/css'))
			foreach ($asserts as $css)
				if ($css != '.' && $css != '..')
					echo "<link rel='stylesheet' type='text/css' href='_asserts/css/$css'>";
	?>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Germania+One|Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <?php
		if ($asserts = scandir('_asserts/js'))
			foreach ($asserts as $js)
				if ($js != '.' && $js != '..')
					echo "<script src='_asserts/js/$js'></script>";
			
	?>
</head>