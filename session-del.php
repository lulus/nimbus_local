<?php
$files = glob('sessions/*'); //get all file names
foreach($files as $file){
    if(is_file($file)){
        unlink($file); //delete file
    }
}
?>