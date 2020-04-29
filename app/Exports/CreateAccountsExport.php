<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class CreateAccountsExport implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct($paramA, $paramB, $paramC)
    {
      $this->startdate=$paramA;
      $this->closedate=$paramB;
      $this->type=$paramC;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }

    public function title(): string
    {
        return 'Creación de Cuentas';
    }

    public function view(): View
    {

      if($this->type == 0){
        $queryResults = DB::table('subscribers')
              //->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
              ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
              ->join('users', 'users.id', '=', 'subscribers.user_id')
              //->whereNull('subscriber_subscription_type.closedate')
              ->where('subscribers.created_at', '>=', $this->startdate)
              ->where('subscribers.created_at', '<=', $this->closedate)
              ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscribers.created_at as suscripcion', 'subscription_types.name as typeSuscrupcion', 'subscription_types.type')
              ->orderBy('subscribers.name','asc')
              ->get();

      }else{//if ($this->type == 'Gratuita' || $this->type == 'Pago' || $this->type == 'Venezuela') {
        $queryResults = DB::table('subscribers')
              //->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
              ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
              ->join('users', 'users.id', '=', 'subscribers.user_id')
              //->whereNull('subscriber_subscription_type.closedate')
              ->where('subscription_types.id', '=', $this->type )
              ->where('subscribers.created_at', '>=', $this->startdate)
              ->where('subscribers.created_at', '<=', $this->closedate)
              ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscribers.created_at as suscripcion', 'subscription_types.name as typeSuscrupcion', 'subscription_types.type')
              ->orderBy('subscribers.name','asc')
              ->get();
      }

      return view('exportcreatedaccount', [
          'queryResults' => $queryResults
      ]);
    }
}
