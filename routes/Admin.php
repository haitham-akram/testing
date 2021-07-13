<?php
Route::get('/admin', function () {
    return 'welcome admin';
});
Route::namespace('Front')->group(function (){
    //all route only access controller or methods in folder name front
    Route::get('showAdmin','AdminController@index');
});
//Route::prefix('admin')->group(function (){
//    Route::get('index','Front\AdminController@index')->middleware('auth');
//});
Route::group(['prefix'=>'admin','namespace'=>'Front'],function (){
    Route::get('index','AdminController@index');
});
//Route::get('login',function (){
//    return 'you must login';
//})->name('login');
Route::get('index2','Front\AdminController@index2');
Route::get('index3','Front\AdminController@index3');

Route::group(['namespace'=>'News'],function (){
    Route::resource('news','NewsController');
});
