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
Route::get('gestion_suscriptores','SubscribersController@indexSubscribers');

Route::get('suscriptores/{type}', 'SubscribersController@listSubscribers');
Route::post('suscriptores/{type}', 'SubscribersController@listSubscribers');

Route::get('suscriptores/{type}/{startdate}/{closedate}', 'specialsController@listSubscribersByFilterWihtParams');
Route::post('suscriptores', 'SubscribersController@listSubscribersByFilter');

Route::get('suscriptor/detalle/{id}/{type}/{startdate}/{closedate}', 'SubscribersController@showSubscriber');

Route::get('suscriptor/edicion/{id}/{type}/{startdate}/{closedate}', 'SubscribersController@editSubscriber');
Route::post('suscriptor/edicion/{id}', 'SubscribersController@updateSubscriber');

Route::get('suscriptor/edicion_pw/{id}/{type}/{startdate}/{closedate}', 'SubscribersController@editPasswordSubscriber');
Route::post('suscriptor/edicion_pw/{id}', 'SubscribersController@updatePasswordSubscriber');

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

Route::get('suscribase_ahora','SubscribeNowsController@indexSubscribeNow');

Route::get('suscribase_ahora/detalle/{id}','SubscribeNowsController@showSubscribeNow');
Route::get('suscribase_ahora/edicion/{id}','SubscribeNowsController@editSubscribeNow');
Route::post('suscribase_ahora/edicion/{id}','SubscribeNowsController@updateSubscribeNow');

Route::get('pagos_config','ButtonRecordsController@index');
Route::get('pagos_config/{accion}', 'ButtonRecordsController@modifyButton');

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
Route::get('conversion_cuenta_excel/{dateIni}/{dateFin}', 'ExportsController@xlsPublicConversionAccount');
Route::get('creacion_cuenta_excel/{dateIni}/{dateFin}/{typeSubscription}', 'ExportsController@xlsCreatedAccount');
Route::get('canales_pago_excel/{dateIni}/{dateFin}', 'ExportsController@xlsPaymentUses');
Route::get('pagos_recibidos_excel/{dateIni}/{dateFin}', 'ExportsController@xlsPaymentsReceived');
Route::get('cuentas_por_vencer_excel/{dateIni}/{dateFin}', 'ExportsController@xlsAccountExpire');
