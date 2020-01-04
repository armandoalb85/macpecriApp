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

      $listUses[] = array();
      $i=0;

      $queryResults = DB::table('payment_methods')
        ->join('payment_method_records', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
        ->where('payment_method_records.startdate', '>=',  $this->startdate)
        ->where('payment_method_records.startdate', '<=',  $this->closedate)
        ->select('payment_methods.name')->distinct()->get();

      foreach ($queryResults as $queryResult) {

        $totalPay = DB::table('payment_methods')
              ->join('payment_method_records', 'payment_methods.id','=','payment_method_records.paymentmethod_id')
              ->where('payment_methods.name', '=', $queryResult->name )
              ->count('payment_method_records.id');
        $listUses[$i] = $totalPay;
        $i ++;
      }

        return view('exportpaymentuses', [
            'queryResults' => $queryResults,
            'listUses' => $listUses
        ]);

    }
}
