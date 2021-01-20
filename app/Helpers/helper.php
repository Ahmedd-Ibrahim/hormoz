<?php

use Intervention\Image\ImageManagerStatic as Image;

function UploadImage($folder, $image){
    $image->store('/',$folder);
    $fileName = $image->hashNAme();
    return  $folder . '/' . $fileName;
}

function Resize($imageFile,$path_to_save,$width,$hight)
{
    $image       = $imageFile;
    $filename    = $image->hashName();
    $image_resize = Image::make($image->getRealPath());
    $image_resize->resize($width, $hight);
    $image_resize->save(public_path('/images/'. $path_to_save.'/' .$filename));
    return $path_to_save . '/' . $filename;
}
