<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Website
Route::namespace('App\Http\Controllers')->group(function(){

    Route::middleware('auth')->namespace('Website')->group(function(){
        Route::get('/certificate',                 'IndexController@index');
        Route::get('/found_pet',                   'FindpetController@index');
        Route::post('/found_pet/store',            'FindpetController@store');
        Route::put('/found_pet/update',            'FindpetController@update');
        Route::delete('/found_pet/destroy/{id}',   'FindpetController@destroy');
        Route::get('/found_pet/flyerById/{id}',    'FindpetController@flyerById');

        Route::get('/losting_pet',                   'LostpetController@index');
        Route::post('/losting_pet/store',            'LostpetController@store');
        Route::put('/losting_pet/update',            'LostpetController@update');
        Route::delete('/losting_pet/destroy/{id}',   'LostpetController@destroy');
        Route::get('/losting_pet/flyerById/{id}',    'LostpetController@flyerById');

        Route::get('/pet_passport',                                  'PetpassportController@index');
        Route::get('/pet_passport/get_passport_by_userId/{User_id}', 'PetpassportController@getPassportByUserId');
        Route::post('/pet_passport/store',                           'PetpassportController@store');
        Route::put('/pet_passport/update',                           'PetpassportController@update');
        Route::delete('/pet_passport/destroy/{id}',                  'PetpassportController@destroy');

        Route::get('/petConcierge',                   'PetConciergeController@index');
        Route::post('/petConcierge/store',            'PetConciergeController@store');
        Route::put('/petConcierge/update',            'PetConciergeController@update');
        Route::delete('/petConcierge/destroy/{id}',   'PetConciergeController@destroy');

        Route::get('/{any?}',                       'IndexController@index');
        Route::get('/find_pet_flyer/{any?}',        'IndexController@index');
        Route::get('/lost_pet_flyer/{any?}',        'IndexController@index');
    });

});
