<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SubscribersExport;
use App\Exports\ConversionAccountsExport;
use App\Exports\CreateAccountsExport;
use App\Exports\ExpireAccountsExport;
use App\Exports\PaymentUsesExport;
use App\Exports\ReceivePaymentsExport;

class ExportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*public function subscriberExcelExport(){
      return Excel::download(new SubscribersExport, 'subscribers.xlsx');
    }*/

    /*
    *
    */
    public function xlsPublicConversionAccount(){
      return Excel::download(new ConversionAccountsExport('2019-02-10','2019-06-10'), 'CuentasConConversion.xlsx');
    }

    /*
    *
    */
    public function xlsCreatedAccount(){
      return Excel::download(new CreateAccountsExport('2019-02-10','2019-06-10'), 'CreacionDeCuenta.xlsx');
    }

    /*
    *
    */
    public function xlsPaymentUses(){

    }

    /*
    *
    */
    public function xlsPaymentsReceived(){

    }

    /*
    *
    */
    public function xlsAccountExpire(){

    }

    /*
    This method allow aplicate format on date parameter
    */
    private function dateFormat($value){
        $date;

        if($value != ''){
          $date = explode('/', $value);
          return $date[2].'-'.$date[0].'-'.$date[1];
        }else{
          return date("Y").'-'.date("m").'-'.date("d");
        }
    }
}
