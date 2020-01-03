<?php
/*use App\Exports\SubscribersExport;
use Maatwebsite\Excel\Facades\Excel;*/
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
Route::get('suscriptores', 'SubscribersController@indexSubscribers');

Route::get('pagos_realizados', 'SubscribersController@checkPaymentsBySubscribers');
Route::get('pagos_pendientes', 'SubscribersController@checkSubscribersWithDebts');

Route::post('pagos_realizados', 'SubscribersController@listPaymentBySubscribers');
Route::post('pagos_pendientes', 'SubscribersController@listDebtsBySubscribers');

//Config routes
Route::get('suscripciones','SubscriptionTypesController@indexSubscriptionType');
Route::get('suscripciones/nuevo', 'SubscriptionTypesController@newSubscriptionType');
Route::post('suscripciones/nuevo', 'SubscriptionTypesController@saveSubscriptionType');
Route::get('/suscripciones/detalle/{id}','SubscriptionTypesController@showSubscriptionType');
Route::get('/suscripciones/edicion/{id}','SubscriptionTypesController@editSubscriptionType');
Route::post('/suscripciones/edicion/{id}', 'SubscriptionTypesController@updateSubscriptionType');
Route::get('/suscripciones/borrar/{id}','SubscriptionTypesController@destroySubscriptionType');

Route::get('suscribase_ahora','SubscribeNowsController@indexSubscribeMessageConfig');
Route::get('suscribase_ahora/detalle/{id}','SubscribeNowsController@showSubscribeMessageConfig');
Route::get('suscribase_ahora/edicion/{id}','SubscribeNowsController@editSubscribeMessageConfig');
Route::post('suscribase_ahora/edicion/{id}','SubscribeNowsController@updateSubscribeMessageConfig');
Route::get('suscribase_ahora/nuevo','SubscribeNowsController@newSubscribeMessageConfig');
Route::post('suscribase_ahora/nuevo','SubscribeNowsController@saveSubscribeMessageConfig');
Route::get('suscribase_ahora/borrar/{id}','SubscribeNowsController@destroySubscribeMessageConfig');

Route::get('mensajes/detalle/{id}','SubscriptionMessagesController@showSubscriptionMessage');
Route::get('mensajes/nuevo/{id}','SubscriptionMessagesController@newSubscriptionMessage');
Route::post('mensajes/nuevo/{id}','SubscriptionMessagesController@saveSubscriptionMessage');
Route::get('mensajes/edicion/{id}','SubscriptionMessagesController@editSubscriptionMessage');
Route::post('mensajes/edicion/{id}','SubscriptionMessagesController@updateSubscriptionMessage');
Route::get('mensajes/borrar/{id}','SubscriptionMessagesController@destroySubscriptionMessage');

//Newsletters routes
Route::get('boletines','NewslettersController@indexNewsletters');
Route::get('boletines/nuevo','NewslettersController@newNewsletters');
Route::post('boletines/nuevo','NewslettersController@saveNewsletters');
Route::get('boletines/detalle/{id}','NewslettersController@showNewsletter');
Route::get('boletines/edicion/{id}','NewslettersController@editNewsletter');
Route::post('boletines/edicion/{id}','NewslettersController@updateNewsletter');
Route::get('boletines/borrar/{id}','NewslettersController@destroyNewsletters');

//Reports
Route::get('r_conversion_cuenta','ReportsController@filterPublicConversionAccount');
Route::post('r_conversion_cuenta','ReportsController@reportPublicConversionAccount');

Route::get('r_creacion_cuenta','ReportsController@filterCreatedAccount');
Route::post('r_creacion_cuenta','ReportsController@reportCreatedAccount');

Route::get('r_canales_pago','ReportsController@filterPaymentUses');
Route::post('r_canales_pago','ReportsController@reportPaymentUses');

Route::get('r_pagos_recibidos','ReportsController@filterPaymentsReceived');
Route::post('r_pagos_recibidos','ReportsController@reportPaymentsReceived');

Route::get('r_cuentas_por_vencer','ReportsController@filterAccountExpire');
Route::post('r_cuentas_por_vencer','ReportsController@reportAccountExpire');

//Exports
/*Route::get('/excel', 'ExportsController@subscriberExcelExport');*/
Route::get('conversion_cuenta_excel', 'ExportsController@xlsPublicConversionAccount');
Route::get('creacion_cuenta_excel', 'ExportsController@xlsCreatedAccount');
Route::get('canales_pago_excel', 'ExportsController@xlsPaymentUses');
Route::get('pagos_recibidos_excel', 'ExportsController@xlsPaymentsReceived');
Route::get('cuentas_por_vencer_excel', 'ExportsController@xlsAccountExpire');
