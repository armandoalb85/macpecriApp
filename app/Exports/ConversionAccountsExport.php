<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Http\Controllers\SubscribersController;
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
        $sc = new SubscribersController();

        $totalPay = $sc->countSubscribers(2);
        $totalFree = $sc->countSubscribers(1);
        
        $queryResults = DB::table('convertion_accounts')
            ->join('subscribers', 'subscribers.id', '=', 'convertion_accounts.subscriber_id')
            ->join('users', 'users.id', '=', 'subscribers.user_id')
            ->join('payment_methods', 'payment_methods.id', '=', 'convertion_accounts.paymentmethod_id')
            ->where('convertion_accounts.startdate', '>=', $this->startdate)
            ->where('convertion_accounts.startdate', '<=', $this->closedate)
            ->where('users.status_id', '=', 1)
            ->select('subscribers.name', 'subscribers.lastname', 'users.email', 
            'subscribers.created_at', 'convertion_accounts.startdate', 
            'payment_methods.name as method')
            ->get();
  
        return view('exportpublicconversionaccount', [
            'queryResults' => $queryResults,
            'totalPay' => $totalPay,
            'totalFree' => $totalFree
        ]);
    }
}
