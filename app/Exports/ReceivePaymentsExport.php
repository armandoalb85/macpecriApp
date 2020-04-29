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

        $queryResults =DB::table('payment_account_statements')
            ->join('payment_methods', 'payment_methods.id','=','payment_account_statements.paymentmethod_id')
            ->whereNotNull('payment_account_statements.closedate')
            ->where('payment_account_statements.startdate', '>=', $this->startdate)
            ->where('payment_account_statements.startdate', '<=', $this->closedate)
            ->where('payment_methods.status', '=', 1)
            ->where('payment_account_statements.subscriber_id', '>', 0)
            ->select('payment_methods.name',DB::raw('SUM(payment_account_statements.amount) AS amount'))
            ->groupBy('payment_account_statements.paymentmethod_id')
            //->toSql();
            ->get();

        return view('exportPaymentsReceived', [
            'queryResults' => $queryResults
        ]);
    }
}