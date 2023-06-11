<?php

namespace App\Http\Controllers\Website;

use Auth;
use File;
use Image;
use Carbon\Carbon;
use App\Models\Web\PetPassport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\DocImgUpload;

class PetpassportController extends Controller
{
    //index
    public function index(){
        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'desc');
        $sort_field     = Request('sort_field', 'id');

        $allData = PetPassport::orderBy($sort_field, $sort_direction)
                ->paginate($paginate);
        return response()->json($allData, 200);

    }

    public function getPassportByUserId($userId){
        $get_data = PetPassport::where('user_id', $userId)->first();
        return response()->json($get_data, 200);
    }

    // store
    public function store(Request $request){

        $data = new PetPassport();

        $imagePath      = public_path('images/backend/petpassport/');
        $imagePathSm    = public_path('images/backend/petpassport/small/');
        
        // Save Image
        $current_image  = $request->image;
        if(!empty($current_image)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image, null, $imagePath, $imagePathSm);
            $data->image = $imgName;

            // // Random srting
            // $randomName = Str::random(10);
            // // Final Name
            // $name = $randomName . time().'.' . explode('/', explode(':', substr($current_image, 0, strpos($current_image, ';')))[1])[1];
            // // Original Image Save
            // \Image::make($current_image)
            // ->save($imagePath.$name);
            // // Resized image save
            // \Image::make($current_image)
            // ->resize(200, 200)
            // ->save($imagePathSm.$name);
            
            // $data->image = $name;
        }

        $current_image2  = $request->image2;
        if(!empty($current_image2)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image2, null, $imagePath, $imagePathSm);
            $data->image2 = $imgName;
        }

        $current_image3  = $request->image3;
        if(!empty($current_image3)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image3, null, $imagePath, $imagePathSm);
            $data->image3 = $imgName;
        }

        $current_image4  = $request->image4;
        if(!empty($current_image4)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image4, null, $imagePath, $imagePathSm);
            $data->image4 = $imgName;
        }

        $current_image5  = $request->image5;
        if(!empty($current_image5)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image5, null, $imagePath, $imagePathSm);
            $data->image5 = $imgName;
        }

        $current_image6  = $request->image6;
        if(!empty($current_image6)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image6, null, $imagePath, $imagePathSm);
            $data->image6 = $imgName;
        }

        $current_image7  = $request->image7;
        if(!empty($current_image7)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image7, null, $imagePath, $imagePathSm);
            $data->image7 = $imgName;
        }

        $current_image8  = $request->image8;
        if(!empty($current_image8)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image8, null, $imagePath, $imagePathSm);
            $data->image8 = $imgName;
        }

        $current_image9  = $request->image9;
        if(!empty($current_image9)){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image9, null, $imagePath, $imagePathSm);
            $data->image9 = $imgName;
        }

        $success             = $data->save();

        if($success){
            return response()->json(['msg' => saved_success(), 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }

    }

    // update
    public function update(Request $request){

        if($request->id){
            $data           = PetPassport::find($request->id);
        }else{
            $data           = new PetPassport();
        }
        

        $imagePath      = public_path('images/backend/petpassport/');
        $imagePathSm    = public_path('images/backend/petpassport/small/');

        // update Image
        $current_image  = $request->image;
        $old_image      = $data->image;
        if($current_image != $old_image){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image, $old_image, $imagePath, $imagePathSm);
            $data->image = $imgName;
        }

        $current_image2  = $request->image2;
        $old_image2      = $data->image2;
        if($current_image2 != $old_image2){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image2, $old_image2, $imagePath, $imagePathSm);
            $data->image2 = $imgName;
        }

        $current_image3  = $request->image3;
        $old_image3      = $data->image3;
        if($current_image3 != $old_image3){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image3, $old_image3, $imagePath, $imagePathSm);
            $data->image3 = $imgName;
        }

        $current_image4  = $request->image4;
        $old_image4      = $data->image4;
        if($current_image4 != $old_image4){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image4, $old_image4, $imagePath, $imagePathSm);
            $data->image4 = $imgName;
        }

        $current_image5  = $request->image5;
        $old_image5      = $data->image5;
        if($current_image5 != $old_image5){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image5, $old_image5, $imagePath, $imagePathSm);
            $data->image5 = $imgName;
        }

        $current_image6  = $request->image6;
        $old_image6      = $data->image6;
        if($current_image6 != $old_image6){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image6, $old_image6, $imagePath, $imagePathSm);
            $data->image6 = $imgName;
        }

        $current_image7  = $request->image7;
        $old_image7      = $data->image7;
        if($current_image7 != $old_image7){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image7, $old_image7, $imagePath, $imagePathSm);
            $data->image7 = $imgName;
        }

        $current_image8  = $request->image8;
        $old_image8      = $data->image8;
        if($current_image8 != $old_image8){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image8, $old_image8, $imagePath, $imagePathSm);
            $data->image8 = $imgName;
        }

        $current_image9  = $request->image9;
        $old_image9      = $data->image9;
        if($current_image9 != $old_image9){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image9, $old_image9, $imagePath, $imagePathSm);
            $data->image9 = $imgName;
        }

        $current_image10  = $request->image10;
        $old_image10      = $data->image10;
        if($current_image10 != $old_image10){
            $imgName = DocImgUpload::passportImageUplaodByName($current_image10, $old_image10, $imagePath, $imagePathSm);
            $data->image10 = $imgName;
        }

        $data->user_id = Auth::user()->id;

        $success             = $data->save();

        if($success){
            return response()->json(['msg' => updated_success(), 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }

    }

    // destroy
    public function destroy($id)
    {
         $data           =  PetPassport::find($id);
 
         $imagePath      = 'images/backend/petpassport/';
         $imagePathSm    = $imagePath . 'small/';
         $old_image      = $data->image;
         if(!empty($old_image)){
             //Delete Old File
             if (file_exists($imagePath . $old_image)){
                 unlink( $imagePath . $old_image );
             }
             if (file_exists($imagePathSm . $old_image)){
                 unlink( $imagePathSm . $old_image );
             }
         }
 
         $success    =  $data->delete();
         return response()->json('success', 200);
    }
}
