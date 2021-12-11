<?php
$targetdir = './files/';
$prefix = str_replace('./', '', $targetdir);

function getDirContents($path) {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

    $files = array(); 
    foreach ($rii as $file) {
        if (!$file->isDir()) {
            $files[] = $file->getPathname();
        }
    }
    return $files;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadfile = $targetdir . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
    error_log('Uploaded file: ' . realpath($uploadfile));
} else {
    $files = getDirContents($targetdir);
    sort($files);

    echo '<p>File list</p>';

    foreach ($files as $file) {
        echo '<div><a href="'.$file.'">'.$prefix.str_replace($targetdir, '', $file).'</a></div>';
    }
}
