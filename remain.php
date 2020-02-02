<?php
define('API_URL', 'https://api.telegram.org/bot868385679:AAHea69gcXkC19t85sCx7BUbgFhWWCqpdQc/');

$sendto =API_URL."sendmessage?chat_id=460873343&text=".$argv[1];
file_get_contents($sendto);
?>