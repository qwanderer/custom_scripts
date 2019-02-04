<?php


function resize_image($originalFile, $newWidth, $newHeight, $destination_file="") {

    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    switch ($mime) {
        case 'image/jpeg':
            $image_create_func = 'imagecreatefromjpeg';
            $image_save_func = 'imagejpeg';
            break;

        case 'image/png':
            $image_create_func = 'imagecreatefrompng';
            $image_save_func = 'imagepng';
            break;

        case 'image/gif':
            $image_create_func = 'imagecreatefromgif';
            $image_save_func = 'imagegif';
            break;

        default:
            throw new Exception('Unknown image type.');
    }

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    // TODO - с сохранением пропорций
    //$newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if($destination_file == ""){
        $destination_file = $originalFile;
    }

    if (file_exists($destination_file)) {
        unlink($destination_file);
    }
    //$image_save_func($tmp, "$originalFile.$new_image_ext");
    $image_save_func($tmp, "$destination_file");
}

