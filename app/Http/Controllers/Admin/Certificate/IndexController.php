<?php

namespace App\Http\Controllers\Admin\Certificate;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Certificate;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\DocImgUpload;
use Image;
use File;

class IndexController extends Controller
{
    //index
    public function index(){
        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'desc');
        $sort_field     = Request('sort_field', 'id');

        $allData = Certificate::with('users:id,name')->orderBy($sort_field, $sort_direction)
                ->search( trim(preg_replace('/\s+/' ,' ', $search)) )
                ->paginate($paginate);
        return response()->json($allData, 200);

    }

    // store
    public function store(Request $request){

        //Validate
        $this->validate($request,[
            'animal_id'       => 'required',
            'code'            => 'required',
            'owner_id'        => 'required',
            'name'            => 'required|string|max:100',
            'breed'           => 'required',
            'color'           => 'required',
            'gender'          => 'required',
            'dob'             => 'required',
            'image'           => 'required',
            'image2'          => 'required',
            'sample_id'       => 'required',
            'order_id'        => 'required',
            'report_date'     => 'required',
        ]);

        $data = new Certificate();

        $imagePath      = public_path('images/backend/certificate/');
        $imagePathSm    = public_path('images/backend/certificate/small/');
        
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

        $current_image2  = $request->image2;
        if(!empty($current_image2)){
            // Random srting
            $randomName = Str::random(10);
            // Final Name
            $name = $randomName . time().'.' . explode('/', explode(':', substr($current_image2, 0, strpos($current_image2, ';')))[1])[1];
            // Original Image Save
            \Image::make($current_image2)
            ->save($imagePath.$name);
            // Resized image save
            \Image::make($current_image2)
            ->resize(200, 200)
            ->save($imagePathSm.$name);
            
            $data->image2 = $name;
        }

        $data->animal_id     = $request->animal_id;
        $data->code          = $request->code;
        $data->owner_id      = $request->owner_id;
        $data->name          = $request->name;
        $data->breed         = $request->breed;
        $data->color         = $request->color;
        $data->gender        = $request->gender;
        $data->dob           = $request->dob;
        $data->sample_id     = $request->sample_id;
        $data->order_id      = $request->order_id;
        $data->report_date   = $request->report_date;
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
            'animal_id'       => 'required',
            'code'            => 'required',
            'owner_id'        => 'required',
            'name'            => 'required|string|max:100',
            'breed'           => 'required',
            'color'           => 'required',
            'gender'          => 'required',
            'dob'             => 'required',
            'image'           => 'required',
            'image2'          => 'required',
            'sample_id'       => 'required',
            'order_id'        => 'required',
            'report_date'     => 'required',
        ]);

        $data           = Certificate::find($request->id);

        $imagePath      = public_path('images/backend/certificate/');
        $imagePathSm    = public_path('images/backend/certificate/small/');
        
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

        // Save Image2
        $current_image2  = $request->image2;
        $old_image2      = $data->image2;
        if($current_image2 != $old_image2){
            // Delete Image
            if(!empty($old_image2)){
                //Delete Old File
                if (file_exists($imagePath . $old_image2)){
                    unlink( $imagePath . $old_image2 );
                }
                if (file_exists($imagePathSm . $old_image2)){
                    unlink( $imagePathSm . $old_image2 );
                }
            }

            // Random srting
            $randomName = Str::random(10);
            // Final Name
            $name = $randomName . time().'.' . explode('/', explode(':', substr($current_image2, 0, strpos($current_image2, ';')))[1])[1];
            // Original Image Save
            \Image::make($current_image2)
            ->save($imagePath.$name);
            // Resized image save
            \Image::make($current_image2)
            ->resize(200, 200)
            ->save($imagePathSm.$name);
            
            $data->image2 = $name;
        }

        $data->animal_id     = $request->animal_id;
        $data->code          = $request->code;
        $data->owner_id      = $request->owner_id;
        $data->name          = $request->name;
        $data->breed         = $request->breed;
        $data->color         = $request->color;
        $data->gender        = $request->gender;
        $data->dob           = $request->dob;
        $data->sample_id     = $request->sample_id;
        $data->order_id      = $request->order_id;
        $data->report_date   = $request->report_date;
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
         $data           =  Certificate::find($id);
 
         $imagePath      = 'images/backend/certificate/';
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

         $old_image2      = $data->image2;
         if(!empty($old_image2)){
             //Delete Old File
             if (file_exists($imagePath . $old_image2)){
                 unlink( $imagePath . $old_image2 );
             }
             if (file_exists($imagePathSm . $old_image2)){
                 unlink( $imagePathSm . $old_image2 );
             }
         }
 
         $success    =  $data->delete();
         return response()->json('success', 200);
    }
    
    public function get_certificate_by_id($id){
        $getData = Certificate::with('users:id,name')->where('owner_id', $id)->first();
        dd($getData);
        return response()->json($getData, 200);
    }

    public function get_pet_owner(){
        $allPetOwners =  User::where('u_type', 'po')->where('deleted_temp',0)->get();
        return response()->json($allPetOwners, 200);
    }

    public function get_total_certificate(){
        $count =  Certificate::count();
        return response()->json($count, 200);
    }

}