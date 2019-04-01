<?php 
function insert_link($pwd){

    if ($handle = opendir($pwd)) {
        while (false!== ($file = readdir($handle)))  {
            // INSERT


            if(!is_file($file))
                insert_link($pwd.'/'.$file);

        }
    }
}
?>