<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Browser;

class LoginController extends Controller
{

    public function index(){
        if(Auth::user()){
            return redirect('/admin/index');
        }else{
            return view('login');
        }
    }

    //forget password
    public function recover_password($email){

        $userCheck = User::where('email', $email)->first();

        if ($userCheck) {
            $data['email'] = $email;
            $userCheck->remember_token = Str::random(60);
            $userCheck->save();

            Mail::send('emails.reset_password', $data, function ($message) use ($data) {
                $message->to($data['email'])->subject('Password Reset Link');
            });

            return response()->json(['msg' => 'Password reset link send to your mail successfully', 'status' => true],200);

        } else {

            return response()->json(['status' => false]);
        }
    }

    public function reset_confirm($email){
        $email = $email;
        return view('reset_password', compact('email'));
    }

    public function check_remember_token($email){

        $result = User::where('email', $email)->where('remember_token', '!=', '')->first();
        if(!$result){
            return response()->json(['msg' => 'Token is invalid !', 'status' => false]);
        }else{
            if(Carbon::parse($result->updated_at)->addDay(1) < Carbon::today()){
                return response()->json(['msg' => 'Token is expired !', 'status' => false]);
            }else{
                return response()->json(['msg' => 'Valid Token !', 'status' => true],200);
            }
        }
    }

    public function changePassword(Request $request){

        $this->validate($request,[
			'password'  => 'min:6|required_with:retype_password|same:retype_password',
        ]);

        $data = User::where('email', $request->email)->first();
        $data->password = $request->password;
        $data->remember_token = '';
        if ($data->save()) {
            $mdata['email'] = $request->email;
            $mdata['password'] = $request->password;
            Mail::send('emails.password_changed', $mdata, function ($message) use ($mdata) {
                $message->to($mdata['email'])->subject('Password Succesfully Reset');
            });

            return response()->json(['msg' => 'Password Successfully Reset.!', 'status' => true],200);

        } else {

            return response()->json(['msg' => 'Password Reset Fail', 'status' => false]);
        }

    }

    //check login
    public function authenticate(Request $request){

        Self::validateLogin($request);
        $result = Self::checkCrediantials($request);

        if($result){
            if(auth()->user()->status == 1){
                $user = Auth::user();
                return response()->json([
                    'success' => true,
                    'user'    => $user,
                ], 200);
            }else{
                Session::flush();
                Auth::logout();
                return response()->json(['success' => 'inactive']);
            }
        }else{
            return response()->json(['success' => false]);
        }

    }

    protected static function validateLogin($request){

        $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);
    }

    protected static function checkCrediantials($request){
        $check = User::where('email', $request->email)->where('password', $request->password)->first();

    	if($check){
            Auth::login($check);
            return true;
    	}else{
            return false;
        }
    }

    // update password
    public function update_password(Request $request){

        //Validate
        $this->validate($request,[
            'new_password'        => 'min:6|required_with:retype_password|same:retype_password',
        ]);

        $current_password = Auth::user()->password;
        $old_password = $request->old_password;
        if($old_password == $current_password){
            $data                = User::find(Auth::user()->id);
            $data->password      = $request->new_password;
            $success             = $data->save();
            $status = 'success';
        }else{
            $status = 'fail';
        }
        return response()->json(['status'=>$status]);

    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

}
