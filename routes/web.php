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

//session routes
Auth::routes();

Route::get('/', function () {

    if (Auth::check()){
      return view('dashboard');
    }else{
      return view('auth/login');
    }
});

//System routes
Route:: get('password_modify', function(){
  return view('editpassword');
});
Route::post('user/updatepassword', 'UsersController@updatePassword');

//dashboard route
Route::get('dashboard', 'DashboardController@showDashboard');

//Subscriber admin routes
Route::get('suscriptores', 'SubscribersController@showSubscribers');

//Config routes
Route::get('suscripciones','SubscriptionTypesController@indexSubscriptionType');
Route::get('suscripciones/nuevo', 'SubscriptionTypesController@newSubscriptionType');
Route::post('suscripciones/nuevo', 'SubscriptionTypesController@saveSubscriptionType');

Route::get('/suscripciones/detalle/{id}','SubscriptionTypesController@showSubscriptionType');
Route::get('/suscripciones/edicion/{id}','SubscriptionTypesController@editSubscriptionType');
Route::post('/suscripciones/edicion/{id}', 'SubscriptionTypesController@updateSubscriptionType');

Route::get('/suscripciones/borrar/{id}','SubscriptionTypesController@destroySubscriptionType');

//Newsletters routes
Route::get('boletines','NewslettersController@indexNewsletters');
Route::get('boletines/nuevo','NewslettersController@createNewsletters');
Route::post('boletines/nuevo','NewslettersController@saveNewsletters');

Route::get('boletines/detalle/{id}','NewslettersController@showNewsletters');
Route::get('boletines/edicion/{id}','NewslettersController@editNewsletters');
Route::post('boletines/edicion/{id}','NewslettersController@updateNewsletters');

Route::get('boletines/borrar/{id}','NewslettersController@destroyNewsletters');
