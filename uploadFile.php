<?php
$extensiones = array('jpeg', 'jpg', 'png', 'gif', 'bmp','pdf', 'doc','ppt','txt');

$path = 'Files/';
if($_FILES['image']){

    $file = $_FILES['image']['tmp_name'];

    $tmp = $_FILES['image']['tmp_name'];

    $ext  = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    $final_file = rand(1000,1000000).$file;

    if(in_array($ext, $extensiones)){
        $path = $path.strtolower($final_file);
        if(move_uploaded_file($tmp, $path)) {

            echo "<img src='$path' />";
        }
    }
}
