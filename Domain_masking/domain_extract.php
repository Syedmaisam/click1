<?php

$zip = new ZipArchive;
if ($zip->open('wzip.zip') === TRUE) {
    $zip->extractTo($web_dir_name);
    $zip->close();
} else {
   
}
?>