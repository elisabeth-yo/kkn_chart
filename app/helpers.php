<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

if (!function_exists('handleUploadedImage')) {
    function handleUploadedImage($image, $folderName)
    {
        $imagePath = null;
        $path = 'images/' . $folderName;

        if (!File::isDirectory($path))
            File::makeDirectory($path, 0777, true, true);
        
        if (!is_null($image)) {
            $fileName = time() . $image->getClientOriginalName();
            Storage::disk('public')->put($path . $fileName, File::get($image));
            $imagePath = 'storage/' . $path . $fileName;
        }

        return $imagePath;
    }
}

if (!function_exists('handleDeletedImage')) {
    function handleDeletedImage($imagePath) 
    {
        if (File::exists($imagePath)) {
            unlink($imagePath);
        }
    }
}

if (!function_exists('handleBulkDeletedImage')) {
    function handleBulkDeletedImage($imagePaths)
    {
        foreach ($imagePaths as $imagePath) {
            handleDeletedImage($imagePath);
        }
    }
}