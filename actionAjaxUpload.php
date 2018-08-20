<?php

if(isset($_FILES) && is_array($_FILES)) {

    foreach($_FILES['images']['name'] as $name => $value)
    {
        $file_name = explode(".", $_FILES['images']['name'][$name]);
        $allowed_extension = ["jpg", "jpeg", "png", "gif"];
        if(in_array($file_name[1], $allowed_extension))
        {
            $new_name = rand() . '.'. $file_name[1];
            $sourcePath = $_FILES["images"]["tmp_name"][$name];
            $targetPath = "upload/".$new_name;
            move_uploaded_file($sourcePath, $targetPath);
        }
    }
    $output = '';
    $images = glob("upload/*.*");
    foreach($images as $image)
    {
        $image_name = str_replace('upload/', '', $image);
        $image_name = str_replace(['.jpg', '.jpeg', '.png', '.gif'], '', $image_name);
        $output .= '<img src="' . $image .'" id="'.$image_name.'" class="img-in-zone-loader" onmouseover="showDeleteMessage()" data-src="'.$image.'" ondblclick="deletePhoto()">';
    }
    echo $output;
}