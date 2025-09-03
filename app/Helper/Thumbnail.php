<?php

namespace App\Helper;

use App\Http\Controllers\Controller;
use Image;

class Thumbnail extends Controller
{
    static function make($image, $dimension, $path)
    {
        //get filename with extension
        $fileNameWithExtension = $image->getClientOriginalName();

        //get filename without extension
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);

        //get file extension
        $extension = $image->getClientOriginalExtension();

        //filename to store
        $fileNameToStore = str_replace(' ', '-', $fileName).'-'.time().'.'.$extension;

        //Upload File
        $imagePath = $image->storeAs("images/$path", $fileNameToStore);
        $thumbnailPathMedium = $image->storeAs("images/$path/medium", $fileNameToStore);
        $thumbnailPathSmall = $image->storeAs("images/$path/small", $fileNameToStore);

        //Resize image here
        //Thumbnail Medium
        $thubmnailRealPathMedium = public_path("/storage/$thumbnailPathMedium");
        $thumbnailMedium = Image::make($thubmnailRealPathMedium)->resize($dimension['medium']['width'], $dimension['medium']['height'], function($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailMedium->save($thubmnailRealPathMedium);

        // Thumbnail Small
        $thubmnailRealPathSmall = public_path("/storage/$thumbnailPathSmall");
        $thumbnailSmall = Image::make($thubmnailRealPathSmall)->resize($dimension['small']['width'], $dimension['small']['height'], function($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailSmall->save($thubmnailRealPathSmall);

        return [
            'image' => $imagePath,
            'image_medium' => $thumbnailPathMedium,
            'image_small' => $thumbnailPathSmall,
        ];
    }
}
