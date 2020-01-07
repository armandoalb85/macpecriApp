<?php

use Illuminate\Database\Seeder;

class PaymentAccountStatementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('10/11/2019')),
            'closedate' => date('Y-m-d',strtotime('10/11/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/11/2019')),
            'closedate' => date('Y-m-d',strtotime('11/11/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/11/2019')),
            'closedate' => date('Y-m-d',strtotime('12/11/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/15/2019')),
            'closedate' => date('Y-m-d',strtotime('11/15/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/15/2019')),
            'closedate' => date('Y-m-d',strtotime('12/15/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('05/05/2020')),
            'closedate' => date('Y-m-d',strtotime('05/05/2020')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

    }
}
