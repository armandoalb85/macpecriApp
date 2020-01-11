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

        $queryResults = DB::table('payment_account_statements')
            ->join('payment_method_records', 'payment_method_records.id','=','payment_account_statements.paymentmethod_id')
            ->join('payment_methods', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
            ->whereNotNull('payment_account_statements.closedate')
            ->where('payment_account_statements.startdate', '>=', $this->startdate)
            ->where('payment_account_statements.startdate', '<=', $this->closedate)
            ->select('payment_methods.name as method')->distinct()->get();

        foreach ($queryResults as $queryResult) {

          $totalPayment = DB::table('payment_account_statements')
              ->join('payment_method_records', 'payment_method_records.id','=','payment_account_statements.paymentmethod_id')
              ->join('payment_methods', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
              ->whereNotNull('payment_account_statements.closedate')
              ->where('payment_methods.name','=',$queryResult->method)
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
