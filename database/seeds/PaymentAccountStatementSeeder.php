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
            'startdate' => date('Y-m-d',strtotime('10/01/2019')),
            'closedate' => date('Y-m-d',strtotime('10/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/01/2019')),
            'closedate' => date('Y-m-d',strtotime('11/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/01/2019')),
            'closedate' => null,
            'status' => 'No Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('10/01/2019')),
            'closedate' => date('Y-m-d',strtotime('10/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 2
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/01/2019')),
            'closedate' => date('Y-m-d',strtotime('11/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 2
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/01/2019')),
            'closedate' => null,
            'status' => 'No Pagado',
            'amount' => 1,
            'paymentmethod_id' => 2
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('10/01/2019')),
            'closedate' => date('Y-m-d',strtotime('10/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/01/2019')),
            'closedate' => date('Y-m-d',strtotime('11/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/01/2019')),
            'closedate' => null,
            'status' => 'No Pagado',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('10/01/2019')),
            'closedate' => date('Y-m-d',strtotime('10/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 4
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/01/2019')),
            'closedate' => null,
            'status' => 'No Pagado',
            'amount' => 1,
            'paymentmethod_id' => 4
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/01/2019')),
            'closedate' => null,
            'status' => 'No Pagado',
            'amount' => 1,
            'paymentmethod_id' => 4
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('10/01/2019')),
            'closedate' => date('Y-m-d',strtotime('10/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 5
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/01/2019')),
            'closedate' => null,
            'status' => 'No Pagado',
            'amount' => 1,
            'paymentmethod_id' => 5
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/01/2019')),
            'closedate' => null,
            'status' => 'No Pagado',
            'amount' => 1,
            'paymentmethod_id' => 5
        ]);
    }
}