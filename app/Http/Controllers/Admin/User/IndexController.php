<?php

namespace App\Http\Controllers\Admin\User;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Common\DocImgUpload;

class IndexController extends Controller
{

    //index
    public function index(){
        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'desc');
        $sort_field     = Request('sort_field', 'id');

        $allData = User::with('roles')->orderBy($sort_field, $sort_direction)
                ->where('deleted_temp', 0)
                ->search( trim(preg_replace('/\s+/' ,' ', $search)) )
                ->paginate($paginate);
                //->get()->toArray();

        return response()->json($allData, 200);

    }

    //temp_deleted_user
    public function temp_deleted_user(){
        $paginate       = Request('paginate', 10);
        $search         = Request('search', '');
        $sort_direction = Request('sort_direction', 'desc');
        $sort_field     = Request('sort_field', 'id');

        $allData = User::orderBy($sort_field, $sort_direction)
                ->where('deleted_temp', 1)
                ->search( trim(preg_replace('/\s+/' ,' ', $search)) )
                ->paginate($paginate);

        return response()->json($allData, 200);

    }

    // store
    public function store(Request $request){

        //Validate
        $this->validate($request,[
            'name'            => 'required|string|max:100',
            'email'           => 'required|email|unique:users',
            'u_type'          => 'required',
            'mobile_no'       => 'required|max:15',
            'password'        => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ]);

        $data = new User();

        $data->name          = $request->name;
        $data->email         = $request->email;
        $data->mobile_no     = $request->mobile_no;
        $data->u_type        = $request->u_type;
        $data->password      = $request->password;
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
            'name'            => 'required|string|max:100',
            'email'           => 'required|email|unique:users,email,'.$request->id,
            'mobile_no'       => 'required|max:15',
            'u_type'          => 'required',
        ]);

        $data           = User::find($request->id);

        $data->name          = $request->name;
        $data->email         = $request->email;
        $data->mobile_no     = $request->mobile_no;
        $data->u_type        = $request->u_type;
        $success             = $data->save();

        if($success){
            return response()->json(['msg' => updated_success(), 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }

    }

    // status
    public function status($id){

        $data       =  User::find($id);
        if($data){
           $status = $data->status;
            if($status == 1){
                $data->status = 0;
            }else{
                $data->status = 1;
            }
            $success    =  $data->save();
            return response()->json('success', 200);
        }
    }

    // restore user
    public function restore_user($id){

        $data                   = User::findOrFail($id);
        $data->deleted_temp     = 0;
        $data->deleted_by       = 'NULL';
        $data->updated_at       = Carbon::now();
        $success                = $data->save();

        if($success){
            return response()->json(['msg' => 'Restored Successfully &#128515;', 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }
    }

    // destroy
    public function destroy($id)
    {
        $data           =  User::find($id);
        $success    =  $data->delete();
        return response()->json('success', 200);
    }

    // destroyTemp
    public function destroy_temp($id){

        $data                   = User::findOrFail($id);
        $data->deleted_temp     = 1;
        $data->deleted_by       = Auth::user()->id;
        $data->updated_at       = Carbon::now();
        $success                = $data->save();

        if($success){
            return response()->json(['msg' => 'Deleted Successfully &#128515;', 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }
    }

    //Bulk delete
    public function deleteAll(Request $request){
        $count = 0;
        foreach($request->data as $id){
            $data           =  User::find($id);
            $data->delete();
            $count++;
        }
        $success = $count > 0 ? true : false;
        return response()->json(['success' => $success, 'total' => $count], 200);

    }

    //Bulk status active
    public function statusActiveAll(Request $request){
        $count = 0;
        foreach($request->data as $id){
            $data         =  User::find($id);
            $data->status = 1;
            $data->save();
            $count++;
        }
        $success = $count > 0 ? true : false;
        return response()->json(['success' => $success, 'total' => $count], 200);
    }

    //Bulk status deactive
    public function statusDeactiveAll(Request $request){
        $count = 0;
        foreach($request->data as $id){
            $data         =  User::find($id);
            $data->status = 0;
            $data->save();
            $count++;
        }
        $success = $count > 0 ? true : false;
        return response()->json(['success' => $success, 'total' => $count], 200);

    }

    //count online user
    public function total_online_user(){
        $count = User::where('last_activity', '>=', Carbon::now()->format('Y-m-d H:i'))->count();
        return response()->json($count,200);
    }

    //get roles
    public function getRoles(){

        $roles = Role::get();

        foreach($roles as $key => $value){
            if(($pos = strpos($value->name, '-')) !== FALSE){
                $string = substr($value->name, $pos+1);
                $value->new_text = $string;
                $value->key_name = explode('-', $value->name)[0];
            }else{
                $value->new_text = $value->name;
                $value->key_name = $value->name;
            }
        }

        $result = $roles->groupBy('key_name')->toArray();

        //dd($result);

        // $moduleArr = [];
        // $permissonArr = [];
        // foreach($roles as $key => $value){
        //     $module = explode('-', $value['name']);
        //     $moduleArr[] = [
        //         $module[0]
        //     ];
        //     $permissonArr[$module[0]][$key] = 'actions';
        // }
        // dd($roles);
        return response()->json(['get_all_roles'=>$result],200);
    }

    //with axios request
    public function updateRole(Request $request){

        $request = (object) $request['data'];
        //dd($request->id);
        //dd($request['data']['id'], $request->all());

        $data                = User::find($request->id);
        // Role Sync
        $data->roles()->sync($request->role_id);
        $success             = $data->save();

        if($success){
            return response()->json(['msg' => updated_success(), 'icon'=>'success'], 200);
        }else{
            return response()->json(['msg' => exception()], 422);
        }

    }

}
