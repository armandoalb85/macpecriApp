<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class PaymentUsesExport implements FromView, ShouldAutoSize, WithEvents
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

        $queryResults = DB::table('payment_methods')
        ->join('payment_account_statements', 'payment_methods.id','=','payment_account_statements.paymentmethod_id')
        ->where('payment_account_statements.startdate', '>=', $this->startdate)
        ->where('payment_account_statements.startdate', '<=', $this->closedate)
        ->select('payment_methods.name',DB::raw('SUM(payment_account_statements.amount) AS amount'),
            DB::raw('COUNT(payment_account_statements.amount) AS counting'))
        ->groupBy('payment_account_statements.paymentmethod_id')
        ->get();

        return view('exportpaymentuses', [
            'queryResults' => $queryResults
        ]);

    }
}
