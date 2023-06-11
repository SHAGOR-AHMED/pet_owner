<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use Illuminate\Support\Str;

class DocImgUpload extends Controller
{
    //documentUpload
    public static function documentUpload($document, $oldDoc=null, $uploadDocPath = 'images/', $docName=null){

        // Delete Old Doc file
        if(!empty($oldDoc)){
            if (file_exists($uploadDocPath . $oldDoc)){
                unlink( $uploadDocPath . $oldDoc );
            }
        }

        $document_full_name = '';
        if($document){
            $document_name      = $docName.time().Str::random(15);
            $ext                = strtolower($document->getClientOriginalExtension());
            $document_full_name = $document_name . '.' . $ext;
            $document->storeAs($uploadDocPath,$document_full_name, ['disk' => 'my_files']);
        }
        return $document_full_name;
    }

    // Image Uplpoad By name
    public static function imageUplaodByName($currentImage, $oldImage=null, $imagePath, $width=300, $height=200, $imagePathSm=null){

        // Image Path
        if( $imagePathSm == null ){
            $imagePathSm = $imagePath . 'small/';
        }

        // Delete Image
        if(!empty($oldImage)){
            //Delete Old File
            if (file_exists($imagePath . $oldImage)){
                unlink( $imagePath . $oldImage );
            }
            if (file_exists($imagePathSm . $oldImage)){
                unlink( $imagePathSm . $oldImage );
            }
        }

        // Random srting
        $randomName = Str::random(10);
        // Final Name
        $name = $randomName . time().'.' . explode('/', explode(':', substr($currentImage, 0, strpos($currentImage, ';')))[1])[1];
        // Original Image Save
        \Image::make($currentImage)
        ->save($imagePath.$name);
        // Resized image save
        \Image::make($currentImage)
        ->resize($width, $height)
        ->save($imagePathSm.$name);

        return $name;

    }

    // Passport Image Uplpoad By name
    public static function passportImageUplaodByName($currentImage, $oldImage=null, $imagePath, $imagePathSm=null, $width=300, $height=200){

        // Delete Image
        if(!empty($oldImage)){
            //Delete Old File
            if (file_exists($imagePath . $oldImage)){
                unlink( $imagePath . $oldImage );
            }
            if (file_exists($imagePathSm . $oldImage)){
                unlink( $imagePathSm . $oldImage );
            }
        }

        // Random srting
        $randomName = Str::random(10);
        // Final Name
        $name = $randomName . time().'.' . explode('/', explode(':', substr($currentImage, 0, strpos($currentImage, ';')))[1])[1];
        // Original Image Save
        \Image::make($currentImage)
        ->save($imagePath.$name);
        // Resized image save
        \Image::make($currentImage)
        ->resize($width, $height)
        ->save($imagePathSm.$name);

        return $name;

    }

}
