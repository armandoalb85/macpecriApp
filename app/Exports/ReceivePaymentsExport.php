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

class ReceivePaymentsExport implements FromView, ShouldAutoSize, WithEvents
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
        return 'Pagos Recibidos';
    }

    public function view(): View
    {
        $listPayments = null;
        $listTotal[] = array();
        $i=0;

        $queryResults = DB::table('subscription_types')
            ->join('subscriber_subscription_type', 'subscription_types.id','=','subscriber_subscription_type.subscription_id')
            ->join('subscribers', 'subscriber_subscription_type.subscriber_id','=','subscribers.id')
            ->join('payment_method_records', 'subscribers.id','=','payment_method_records.subscriber_id')
            ->join('payment_account_statements', 'payment_method_records.paymentmethod_id','=','payment_method_records.id')
            ->select('subscription_types.name as type')->distinct()->get();

        foreach ($queryResults as $queryResult) {

          $totalPayment = DB::table('subscription_types')
                ->join('subscriber_subscription_type', 'subscription_types.id','=','subscriber_subscription_type.subscription_id')
                ->join('subscribers', 'subscribers.id','=','subscriber_subscription_type.subscriber_id')
                ->join('payment_method_records', 'subscribers.id','=','payment_method_records.subscriber_id')
                ->join('payment_account_statements', 'payment_method_records.id','=','payment_account_statements.paymentmethod_id')
                ->where('payment_account_statements.status', '=', 'Pagado')
                ->where('subscription_types.name', '=', $queryResult->type)
                ->where('payment_account_statements.startdate', '>=', $this->startdate)
                ->where('payment_account_statements.startdate', '<=', $this->closedate)
                ->sum('payment_account_statements.amount');

          $listTotal[$i] = $totalPayment;
          $i++;
        }

        return view('exportPaymentsReceived', [
            'queryResults' => $queryResults,
            'listTotal' => $listTotal
        ]);
    }
}
