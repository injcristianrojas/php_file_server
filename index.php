<?php
$targetdir = './files/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadfile = $targetdir . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
} else {
    $files = array();
    if (is_dir($targetdir)) {
        if ($dh = opendir($targetdir)) {
            while (($file = readdir($dh)) !== false) {
                if (($file != '.') && ($file != '..')) {
                    $files[] = $file;
                }
            }
            closedir($dh);
        }
    }
    sort($files);

    foreach ($files as $file) {
        echo '<div><a href="'.$targetdir.$file.'">'.$file.'</a></div>';
    }
}
