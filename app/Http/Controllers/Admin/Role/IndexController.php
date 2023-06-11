<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Role;
use Illuminate\Support\Str;
use Auth;

class IndexController extends Controller
{
    //index
    public function index(){

        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'desc');
        $sort_field     = Request('sort_field', 'id');

        $allData = Role::with('usedRole:id,role_id')
                ->search( trim(preg_replace('/\s+/' ,' ', $search)) )
                ->paginate($paginate);

        return response()->json($allData, 200);

    }

    // store
    public function store(Request $request){

        //Validate
        $this->validate($request,[
            'name'       => 'required|unique:roles',
        ]);

        $data                = new Role();
        $data->name          = $request->name;
        $data->slug          = Str::slug($request->name);
        $data->created_by    = Auth::user()->id;
        $success             = $data->save();

        //$success             = Role::create($request->all());

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
            'name'       => 'required|unique:roles,name,'.$request->id,
        ]);
        
        $data                = Role::find($request->id);
        $data->name          = $request->name;
        $data->slug          = Str::slug($request->name);
        $success             = $data->save();
        //$data->update($request->all());

        if($success){
            return response()->json(['msg' => updated_success(), 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }

    }

    // destroy
    public function destroy($id)
    {
        $data       =  Role::find($id);
        $success    =  $data->delete();
        return response()->json('success', 200);

    }

}
