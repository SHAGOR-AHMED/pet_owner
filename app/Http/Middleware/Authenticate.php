<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //dd(url()->full(),url()->current(),Request::url(),URL::current(),URL::full(),url()->previous(),Route::current()->getName());
        //dd(explode('/', url()->full())[3]);
        Session::put('target_url', explode('/', url()->full())[3]);
        if (! $request->expectsJson()) {
            return route('admin-login');
            // return route('login');
        }
    }
}
