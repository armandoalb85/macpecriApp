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

    /*
    *
    */
    public function xlsPublicConversionAccount(Request $request){

      return Excel::download(new ConversionAccountsExport($request->dateIni,$request->dateFin), 'CuentasConConversion.xlsx');
    }

    /*
    *
    */
    public function xlsCreatedAccount(Request $request){

      return Excel::download(new CreateAccountsExport($request->dateIni,$request->dateFin, $request->typeSubscription), 'CreacionDeCuenta.xlsx');
//      dd($request->dateIni.",".$request->dateFin.", ".$request->typeSubscription);
    }

    /*
    *
    */
    public function xlsPaymentUses(Request $request){
      return Excel::download(new PaymentUsesExport($request->dateIni,$request->dateFin), 'MetodosDePagoUsados.xlsx');
    }

    /*
    *
    */
    public function xlsPaymentsReceived(Request $request){
      return Excel::download(new ReceivePaymentsExport($request->dateIni,$request->dateFin), 'PagosRecibidos.xlsx');
    }

    /*
    *
    */
    public function xlsAccountExpire(Request $request){
      return Excel::download(new ExpireAccountsExport($request->dateIni, $request->dateFin), 'CuestasPorVencer.xlsx');
    }

    /*
    This method allow aplicate format on date parameter
    */
    private function dateFormat($value){
        $date;

        if($value != ''){
          $date = explode('-', $value);
          return $date[2].'-'.$date[0].'-'.$date[1];
        }else{
          return date("Y").'-'.date("m").'-'.date("d");
        }
    }
}
