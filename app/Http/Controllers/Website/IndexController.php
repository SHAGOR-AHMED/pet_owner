<?php

namespace App\Http\Controllers\Website;


use Illuminate\Http\Request;
use App\Models\Admin\Certificate;
use App\Models\Admin\WebsiteInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //index
    public function index(){
        $websiteInfo = WebsiteInfo::where('id', 1)->first();
        $certificate = Certificate::with('users:id,name')->where('owner_id', Auth::user()->id)->first();
        return view('website.index', compact('websiteInfo', 'certificate'));
    }

    //get website content
    public function get_website_content(){
        $get_all = WebsiteInfo::get();
        return response()->json($get_all, 200);
    }

}
