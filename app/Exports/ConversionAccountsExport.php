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

class ConversionAccountsExport implements FromView, ShouldAutoSize, WithEvents/*FromView, WithHeadings, ShouldAutoSize, WithEvents*/
{

    public function __construct($paramA, $paramB)
    {
      $this->startdate=$paramA;
      $this->closedate=$paramB;
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
        return 'Cuentas con Conversión';
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

      $subQueryResults = DB::table('subscribers')
            ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('subscription_types', 'subscriber_subscription_type.subscription_id', '=', 'subscription_types.id')
            ->where('subscription_types.type', '=', 'Gratuita')
            ->whereNotNull('subscriber_subscription_type.closedate')
            ->select('subscribers.id')
            ->get();

      $values = array();
      $i=0;
      foreach ($subQueryResults as $subQueryResult){
        $values[$i] = $subQueryResult->id;
        $i++;
      }

      $queryResults = DB::table('subscribers')
            ->join('subscriber_subscription_type', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
            ->join('subscription_types', 'subscriber_subscription_type.subscription_id', '=', 'subscription_types.id')
            ->where('subscription_types.type', '=', 'Pago')
            ->whereIn('subscriber_subscription_type.subscriber_id', $values )
            ->where('subscriber_subscription_type.startdate', '>=', $this->startdate)
            ->where('subscriber_subscription_type.startdate', '<=', $this->closedate)
            ->select('subscription_types.name as type', 'subscriber_subscription_type.startdate', 'subscribers.created_at', 'subscribers.name', 'subscribers.lastname')
            ->get();

        return view('exportpublicconversionaccount', [
            'queryResults' => $queryResults,
            'totalPay' => $totalPay,
            'totalFree' => $totalFree
        ]);
    }
}
