<?php

namespace App\Http\Controllers\Website;

use Auth;
use File;
use Image;
use Carbon\Carbon;
use App\Models\Web\Lostpet;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\DocImgUpload;

class LostpetController extends Controller
{
    //index
    public function index(){
        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'desc');
        $sort_field     = Request('sort_field', 'id');

        $allData = Lostpet::where('user_id', Auth::user()->id)->orderBy($sort_field, $sort_direction)
                ->search( trim(preg_replace('/\s+/' ,' ', $search)) )
                ->paginate($paginate);
        return response()->json($allData, 200);

    }

    // store
    public function store(Request $request){

        //Validate
        $this->validate($request,[
            'name'            => 'required',
            'color'           => 'required',
            'gender'          => 'required',
            'image'           => 'required',
            'weight'          => 'required',
            'lost_location'   => 'required',
            'contact_info'    => 'required',
            'note'            => 'required',
            'reward'          => 'required',
        ]);

        $data = new Lostpet();

        $imagePath      = public_path('images/backend/pet/');
        $imagePathSm    = public_path('images/backend/pet/small/');
        
        // Save Image
        $current_image  = $request->image;
        if(!empty($current_image)){
            // $imgName = DocImgUpload::imageUplaodByName($current_image, null, $imagePath);
            // $data->image = $imgName;

            // Random srting
            $randomName = Str::random(10);
            // Final Name
            $name = $randomName . time().'.' . explode('/', explode(':', substr($current_image, 0, strpos($current_image, ';')))[1])[1];
            // Original Image Save
            \Image::make($current_image)
            ->save($imagePath.$name);
            // Resized image save
            \Image::make($current_image)
            ->resize(200, 200)
            ->save($imagePathSm.$name);
            
            $data->image = $name;
        }
        $data->user_id       = Auth::user()->id;
        $data->name          = $request->name;
        $data->color         = $request->color;
        $data->gender        = $request->gender;
        $data->weight        = $request->weight;
        $data->lost_location  = $request->lost_location;
        $data->contact_info  = $request->contact_info;
        $data->note          = $request->note;
        $data->reward        = $request->reward;
        $success             = $data->save();

        if($success){
            return response()->json(['msg' => saved_success(), 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }

    }

    // update
    public function update(Request $request){

        //Validate
        $this->validate($request,[
            'name'            => 'required',
            'color'           => 'required',
            'gender'          => 'required',
            'image'           => 'required',
            'weight'          => 'required',
            'lost_location'   => 'required',
            'contact_info'    => 'required',
            'note'            => 'required',
            'reward'          => 'required',
        ]);

        $data           = Lostpet::find($request->id);

        $imagePath      = public_path('images/backend/pet/');
        $imagePathSm    = public_path('images/backend/pet/small/');
        
        // Save Image
        $current_image  = $request->image;
        $old_image      = $data->image;
        if($current_image != $old_image){
            // $imgName = DocImgUpload::imageUplaodByName($current_image, $old_image, $imagePath);
            // $data->image = $imgName;

            // Delete Image
            if(!empty($old_image)){
                //Delete Old File
                if (file_exists($imagePath . $old_image)){
                    unlink( $imagePath . $old_image );
                }
                if (file_exists($imagePathSm . $old_image)){
                    unlink( $imagePathSm . $old_image );
                }
            }

            // Random srting
            $randomName = Str::random(10);
            // Final Name
            $name = $randomName . time().'.' . explode('/', explode(':', substr($current_image, 0, strpos($current_image, ';')))[1])[1];
            // Original Image Save
            \Image::make($current_image)
            ->save($imagePath.$name);
            // Resized image save
            \Image::make($current_image)
            ->resize(200, 200)
            ->save($imagePathSm.$name);
            
            $data->image = $name;
        }

        $data->name          = $request->name;
        $data->color         = $request->color;
        $data->gender        = $request->gender;
        $data->weight        = $request->weight;
        $data->lost_location  = $request->lost_location;
        $data->contact_info  = $request->contact_info;
        $data->note          = $request->note;
        $data->reward        = $request->reward;
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
         $data           =  Lostpet::find($id);
 
         $imagePath      = 'images/backend/pet/';
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

    public function flyerById($id){
        $getData = Lostpet::find($id);
        return response()->json($getData, 200);
    }

}