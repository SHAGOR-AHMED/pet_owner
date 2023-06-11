<?php

use Illuminate\Support\Facades\Route;

//Auth & forget password Route
Route::namespace('App\Http\Controllers\Auth')->group(function(){
    Route::get('/',                              'LoginController@index')->name('admin-login');
    Route::post('/login-check',                  'LoginController@authenticate');
    Route::get('/recover-password/{email}',      'LoginController@recover_password');
    Route::get('/reset_confirm/{email}',         'LoginController@reset_confirm');
    Route::get('/check_remember_token/{email}',  'LoginController@check_remember_token');
    Route::post('/change_password',              'LoginController@changePassword');
    Route::put('/update_password',               'LoginController@update_password');
    Route::get('/do-logout',                     'LoginController@logout')->name('do-logout');
});

Route::namespace('App\Http\Controllers')->group(function(){

    Route::middleware('auth', 'online')->namespace('Admin')->prefix('admin')->group(function(){

        Route::get('/index',                     'IndexController@index');
        Route::get('/get_total_user',            'IndexController@total_users');
        Route::get('/visitor',                   'IndexController@get_visitor');
        Route::get('/visitor_count',             'IndexController@visitor_count');

        Route::get('{any?}',                     'IndexController@index');

        //Certificate
        Route::namespace('Certificate')->prefix('certificate')->group(function(){
            Route::get('/index',                        'IndexController@index');
            Route::post('/store',                       'IndexController@store');
            Route::put('/update',                       'IndexController@update');
            Route::delete('/destroy/{id}',              'IndexController@destroy');
            Route::get('/get_pet_owner',                'IndexController@get_pet_owner');
            Route::get('/get_certificate_by_id/{id}',   'IndexController@get_certificate_by_id');
            Route::get('/get_total_certificate',        'IndexController@get_total_certificate');
        });

        //Marker
        Route::namespace('Marker')->prefix('marker')->group(function(){
            Route::get('/index',                        'IndexController@index');
            Route::post('/store',                       'IndexController@store');
            Route::put('/update',                       'IndexController@update');
            Route::delete('/destroy/{id}',              'IndexController@destroy');
            Route::get('/get_pet_owner',                'IndexController@get_pet_owner');
            Route::get('/get_marker_by_id/{owner_id}',  'IndexController@get_marker_by_id');
        });

        //Users
        Route::namespace('User')->prefix('user')->group(function(){
            Route::get('/index',                 'IndexController@index');
            Route::get('/temp_deleted_user',     'IndexController@temp_deleted_user');
            Route::get('/restore_user/{id}',     'IndexController@restore_user');
            Route::post('/store',                'IndexController@store');
            Route::put('/update',                'IndexController@update');
            Route::delete('/destroy_temp/{id}',  'IndexController@destroy_temp');
            Route::delete('/destroy/{id}',       'IndexController@destroy');
            Route::post('/status/{id}',          'IndexController@status');
            Route::get('/get-roles',             'IndexController@getRoles');
            Route::put('/role-update',           'IndexController@updateRole');
            Route::post('/delete-all',           'IndexController@deleteAll');
            Route::post('/bulk-status-active',   'IndexController@statusActiveAll');
            Route::post('/bulk-status-deactive', 'IndexController@statusDeactiveAll');
            Route::get('/total_online_user',     'IndexController@total_online_user');
            
        });

        //Role
        Route::namespace('Role')->prefix('role')->group(function(){
            Route::get('/index',                 'IndexController@index');
            Route::post('/store',                'IndexController@store');
            Route::put('/update',                'IndexController@update');
            Route::delete('/destroy/{id}',       'IndexController@destroy');
        });

    });

});
