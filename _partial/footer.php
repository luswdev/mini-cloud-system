<footer>
	&copy;
	<?php
	echo date("Y")." ";

	$config = json_decode(file_get_contents("_config.json"));
	
	echo $config->author;
	?>
</footer>