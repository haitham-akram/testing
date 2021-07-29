<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('show_id/{id?}',function($id){
    return "welcome".$id;
})->name('a');/// here you use method route if you use name() if not use url
Route::get('landing','LandingController@index');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('redirect/{service}','SocialController@redirect');
Route::get('callback/{service}','SocialController@callback');
Route::group([
    'prefix'=>LaravelLocalization::setlocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function (){
Route::group(['namespace'=>'CRUD','prefix'=>'offer'],function (){
    //Route::get('fillable','CRUDController@getOffers');
    Route::post('store','CRUDController@store');
    Route::get('index','CRUDController@index')->name('offers.index');
    Route::get('create','CRUDController@create');
    Route::get('edit/{id}','CRUDController@edit');
    Route::post('update/{id}','CRUDController@update');
    Route::get('delete/{id}','CRUDController@delete')->name('offer.delete');
});
});
Route::group([
    'prefix'=>LaravelLocalization::setlocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function (){
    Route::group(['namespace'=>'CRUD','middleware'=>'auth'],function (){
        Route::get('youtube','CRUDController@getVideo');
    });
});
////////////ajax start here

Route::group(['prefix'=>'AjaxOffer'],function (){
    Route::get('create','AjaxController@create');
    Route::get('edit/{id}','AjaxController@edit')->name('Ajax.edit');
    Route::post('store','AjaxController@store')->name('Ajax.store');
    Route::post('delete','AjaxController@delete')->name('Ajax.delete');
    Route::post('update','AjaxController@update')->name('Ajax.Update');
});
Route::group([
    'prefix'=>LaravelLocalization::setlocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
],function (){
    Route::group(['prefix'=>'AjaxOffer'],function (){
        Route::get('index','AjaxController@index');

    });
});
    ########## Authentication and guards############
        Route::group(['namespace'=>'Auth','prefix'=>'custom','middleware'=>'CheckAge'],function (){
            Route::get('adult','CustomAuthController@adult')->name('adult');
        });
Route::group(['namespace'=>'Auth','prefix'=>'custom'],function (){
    Route::get('adult','CustomAuthController@notadult')->name('notAdult');
});
Route::group(['namespace'=>'Auth','prefix'=>'custom'],function (){
    Route::get('site','CustomAuthController@site')->name('site')->middleware('auth:web');
    Route::get('admin','CustomAuthController@admin')->name('admin')->middleware('auth:admin');
    Route::get('login/admin','CustomAuthController@login')->name('login.admin');
    Route::post('login/admin','CustomAuthController@checklogin')->name('save.admin.login');
});
    ########## end Authentication and guards############
############ relation routes#######
Route::get('has-one','Relations\RelationsController@hasOneRelation');
Route::get('has-one-revers','Relations\RelationsController@hasOneReversRelation');
Route::get('get-user-has-phone','Relations\RelationsController@getUserHasPhone');
Route::get('get-user-has-phone-with-condition','Relations\RelationsController@getUserHasPhoneWithCondition');
Route::get('get-user-does-not-have-phone','Relations\RelationsController@getUserDoesNotHavePhone');

//Route::get('hospital-has-many','Relations\RelationsController@getHopitals');
##############many to many relation ####
Route::get('doctors/services','Relations\RelationsController@getDoctorServices')->name('doctor.services');
Route::get('services/doctors','Relations\RelationsController@getServiceDoctors')->name('doctor.services');
Route::group(['prefix'=>LaravelLocalization::setlocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],function () {
    Route::get('doctor/services/{id}','Relations\RelationsController@getDoctorServicesByID')->name('doctor.Show.services');
});
Route::post('saveServices-to-doctor','Relations\RelationsController@SaveServicesToDoctor')->name('save.services');

#############end many to many relation###
###############one to many relationship
Route::group(['prefix'=>LaravelLocalization::setlocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],function (){
    Route::get('hospitals','Relations\RelationsController@getHopitals');
    Route::get('doctors/{hopital_id}','Relations\RelationsController@getDoctors');
    Route::get('hospitals_has_doctors','Relations\RelationsController@hospitalsHasDoctors');
    Route::get('hospitals_has_male_doctors','Relations\RelationsController@hospitalsHasMaleDoctors');
    Route::get('hospitals_dont_have_doctors','Relations\RelationsController@hospitalsDontHaveDoctors');
    Route::get('delete_hospital/{hospital_id}','Relations\RelationsController@deleteHospital')->name('hospital.delete');

});
############### end of one to many
#######end relation routes#######
