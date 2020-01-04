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

class ExpireAccountsExport implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct($paramA)
    {
      $this->startdate=$paramA;
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
        $queryResults = null;
        $queryResults = DB::table('subscription_types')
              ->join('subscriber_subscription_type', 'subscription_types.id', '=', 'subscriber_subscription_type.Subscription_id')
              ->join('subscribers', 'subscribers.id', '=', 'subscriber_subscription_type.subscriber_id')
              ->join('payment_method_records', 'subscribers.id', '=', 'payment_method_records.subscriber_id')
              ->join('payment_account_statements', 'payment_method_records.id', '=', 'payment_account_statements.paymentmethod_id')
              ->where('subscription_types.type', '=', 'Pago')
              ->where('payment_account_statements.startdate', '>=', $this->startdate)
              ->whereNull('payment_account_statements.closedate')
              ->select('subscription_types.name as type', 'subscription_types.cost', 'subscription_types.daysforpaying', 'subscribers.name', 'subscribers.lastname', 'payment_account_statements.startdate', 'payment_account_statements.closedate', 'payment_account_statements.amount')
              ->get();


        return view('exportaccountexpire', [
            'queryResults' => $queryResults
        ]);
    }
}
