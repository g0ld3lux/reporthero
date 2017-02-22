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


Route::get('/{vue?}', function () {
    return view('app');
})->where('vue', '[\/\w\.-]*')->name('home');
