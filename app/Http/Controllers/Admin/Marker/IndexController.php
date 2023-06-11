<?php

namespace App\Http\Controllers\Admin\Marker;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Marker;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //index
    public function index(){
        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'desc');
        $sort_field     = Request('sort_field', 'id');

        $allData = Marker::with('users:id,name')->orderBy($sort_field, $sort_direction)
                ->paginate($paginate);
        return response()->json($allData, 200);

    }

    // store
    public function store(Request $request){

        //Validate
        $this->validate($request,[
            'owner_id'        => 'required',
            'text'            => 'required',
        ]);

        $data                = new Marker();
        $data->owner_id      = $request->owner_id;
        $data->text          = $request->text;
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
            'owner_id'        => 'required',
            'text'            => 'required',
        ]);

        $data                = Marker::find($request->id);
        $data->owner_id      = $request->owner_id;
        $data->text          = $request->text;
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
        $data       =  Marker::find($id);
        $success    =  $data->delete();
        return response()->json('success', 200);
    }
    
    public function get_marker_by_id($owner_id){
        $getData = Marker::where('owner_id', $owner_id)->first();
        return response()->json($getData, 200);
    }

    public function get_pet_owner(){
        $allPetOwners =  User::where('u_type', 'po')->where('deleted_temp',0)->get();
        return response()->json($allPetOwners, 200);
    }

}