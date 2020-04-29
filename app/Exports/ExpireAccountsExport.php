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
        $queryResults = null;

        $queryResults = DB::table('payment_account_statements')
        ->join('subscribers', 'subscribers.id', '=', 'payment_account_statements.subscriber_id')
        ->join('users', 'users.id', '=', 'subscribers.user_id')
        ->join('payment_methods', 'payment_methods.id', '=', 'payment_account_statements.paymentmethod_id')
        ->join('subscription_types', 'subscription_types.id', '=', 'subscribers.subscription_types_id')
        ->where('payment_account_statements.closedate', '>=', $this->startdate)
        ->where('payment_account_statements.closedate', '<=', $this->closedate)
        ->where('users.status_id', '=', 1)
        ->where('subscription_types.id', '=', 2)
        ->select('subscribers.name', 'subscribers.lastname', 'users.email', 
        'subscribers.created_at', 'payment_account_statements.closedate', 
        'payment_methods.name as method','payment_account_statements.amount','subscription_types.daysforpaying',
        DB::raw('TIMESTAMPDIFF(DAY, NOW(), payment_account_statements.closedate) AS days_for_expire'))
        ->havingRaw('TIMESTAMPDIFF(DAY, NOW(), payment_account_statements.closedate) <= subscription_types.daysforpaying')
        ->get();

        return view('exportaccountexpire', [
            'queryResults' => $queryResults
        ]);
    }
}
