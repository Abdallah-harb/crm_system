<?php


function uploadImage($folder, $image){

    $image->store('/',$folder);
    $fileName  = $image->hashName();
    return $fileName;
}
