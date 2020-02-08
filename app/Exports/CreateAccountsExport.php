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

      $totalPay = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
            ->whereNull('subscriber_subscription_type.closedate')
            ->where('subscription_types.type', '=', 'Pago')
            ->count('subscriber_subscription_type.id');

      $totalFree = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
            ->whereNull('subscriber_subscription_type.closedate')
            ->where('subscription_types.type', '=', 'Gratuita')
            ->count('subscriber_subscription_type.id');

      if($this->type == 'Todos'){
        $queryResults = DB::table('subscribers')
              ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
              ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
              ->join('users', 'users.id', '=', 'subscribers.user_id')
              ->whereNull('subscriber_subscription_type.closedate')
              ->where('subscribers.created_at', '>=', $this->startdate)
              ->where('subscribers.created_at', '<=', $this->closedate)
              ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscriber_subscription_type.startdate as suscripcion', 'subscription_types.name as typeSuscrupcion', 'subscription_types.type')
              ->get();

      }elseif ($this->type == 'Gratuita' || $this->type == 'Pago' || $this->type == 'Venezuela') {
        $queryResults = DB::table('subscribers')
              ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
              ->join('subscription_types', 'subscription_types.id', '=', 'subscriber_subscription_type.subscription_id')
              ->join('users', 'users.id', '=', 'subscribers.user_id')
              ->whereNull('subscriber_subscription_type.closedate')
              ->where('subscription_types.name', '=', $this->type )
              ->where('subscribers.created_at', '>=', $this->startdate)
              ->where('subscribers.created_at', '<=', $this->closedate)
              ->select('subscribers.name as name', 'subscribers.lastname as lastname', 'users.username as username', 'users.email as email', 'subscriber_subscription_type.startdate as suscripcion', 'subscription_types.name as typeSuscrupcion', 'subscription_types.type')
              ->get();
      }

      return view('exportcreatedaccount', [
          'queryResults' => $queryResults,
          'totalPay' => $totalPay,
          'totalFree' => $totalFree
      ]);
    }
}
