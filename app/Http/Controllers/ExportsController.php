<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
//use App\Exports\SubscribersExport;
use App\Exports\ConversionAccountsExport;
use App\Exports\CreateAccountsExport;
use App\Exports\ExpireAccountsExport;
use App\Exports\PaymentUsesExport;
use App\Exports\ReceivePaymentsExport;

class ExportsController extends Controller
{
    /*public function subscriberExcelExport(){
      return Excel::download(new SubscribersExport, 'subscribers.xlsx');
    }*/

    /*
    *
    */
    public function xlsPublicConversionAccount(){

    }

    /*
    *
    */
    public function xlsCreatedAccount(){

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
}
