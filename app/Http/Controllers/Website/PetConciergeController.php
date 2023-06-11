<?php

namespace App\Http\Controllers\Website;

use Auth;
use File;
use Image;
use Carbon\Carbon;
use App\Models\Web\PetConcierge;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Common\DocImgUpload;

class PetConciergeController extends Controller
{
     //index
     public function index(){
        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'asc');
        $sort_field     = Request('sort_field', 'user_id');
  
        $getData = PetConcierge::orderBy($sort_field, $sort_direction);
        if(Auth::user()->u_type == 'sa'){
            $getData->where('user_id', 0);
        }else{
            $getData->where('user_id', 0)->orWhere('user_id', Auth::user()->id);
        }
        $allData =  $getData->paginate($paginate);

        return response()->json($allData, 200);

    }

    // store
    public function store(Request $request){

        //Validate
        $this->validate($request,[
            'business_name'    => 'required',
            'contact_person'   => 'required',
            'address'          => 'required',
            'address_map'      => 'required',
            'phone_no'         => 'required',
            'website'          => 'required',
            'email'            => 'required',
        ]);

        $data = new PetConcierge();
        
        $data->user_id        = (Auth::user()->u_type == 'sa' ? 0 : Auth::user()->id);
        $data->business_name  = $request->business_name;
        $data->contact_person = $request->contact_person;
        $data->address        = $request->address;
        $data->address_map    = $request->address_map;
        $data->phone_no       = $request->phone_no;
        $data->website        = $request->website;
        $data->email          = $request->email;
        $success              = $data->save();

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
            'business_name'    => 'required',
            'contact_person'   => 'required',
            'address'          => 'required',
            'address_map'      => 'required',
            'phone_no'         => 'required',
            'website'          => 'required',
            'email'            => 'required',
        ]);

        $data           = PetConcierge::find($request->id);

        $data->business_name  = $request->business_name;
        $data->contact_person = $request->contact_person;
        $data->address        = $request->address;
        $data->address_map    = $request->address_map;
        $data->phone_no       = $request->phone_no;
        $data->website        = $request->website;
        $data->email          = $request->email;
        $success              = $data->save();

        if($success){
            return response()->json(['msg' => updated_success(), 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }

    }

    // destroy
    public function destroy($id)
    {
        $data           =  PetConcierge::find($id);
        $data->delete();
        return response()->json('success', 200);
    }
    
}
