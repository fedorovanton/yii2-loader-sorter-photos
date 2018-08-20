<?php

if (isset($_POST['src'])) {
    $img = $_POST['src'];
    if(file_exists($img)) {
        unlink($img);
    };
    $image_name = str_replace('upload/', '', $img);
    $image_name = str_replace(['.jpg', '.jpeg', '.png', '.gif'], '', $image_name);
    echo $image_name;
}