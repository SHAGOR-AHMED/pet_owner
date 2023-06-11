<?php

namespace App\Http\Controllers\Admin;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Web\Visitor;
use App\Models\Admin\Outlet;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\LoginLog;
use App\Models\Admin\Promotion;
use App\Models\Admin\WebsiteInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller
{
    //index
    public function index(){
        $roles = auth()->user()->roles->pluck('slug');
        return view('admin.index', compact('roles'));
    }

    //total user
    public function total_users(){
        $all = User::count();
        return response()->json($all,200);
    }
	
}
