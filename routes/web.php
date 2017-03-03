<?php

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
*/

Route::get('mail/monthly' , function(){

$user = \Reporthero\User::find(1);
$mail = Mail::to('g0ld3lux@gmail.com')->send(new \Reporthero\Mail\MonthlyReport($user));

return 'done';
});



// All Admin Related Actions
Route::group([
    'middleware' => ['jwt.auth','roles'],
    'roles' => ['admin'],
], function() {

Route::get('users' , 'UsersController@index');
Route::get('users/showDeletedUsers' , 'UsersController@showDeletedUsers');
Route::get('users/addUser' , 'UsersController@addUser');
Route::get('users/deleteUser/{id?}' , 'UsersController@deleteUser');
Route::get('users/recoverUser/{id?}' , 'UsersController@recoverUser');
Route::get('users/permaDeleteUser/{id?}' , 'UsersController@permaDeleteUser');
});


// Authenticated User Related Actions
Route::group([
    'middleware' => ['jwt.auth'],
    'prefix' => '@me'
], function() {

Route::get('/' , 'UsersController@me');
Route::get('addKlaviyoApiKeys' , 'UsersController@addKlaviyoApiKeys');
Route::get('changePassword' , 'UsersController@changePassword');
Route::get('viewApiKeys' , 'UsersController@viewApiKeys');
});



Route::get('/{vue?}', function () {
    return view('app');
})->where('vue', '[\/\w\.-]*')->name('home');
