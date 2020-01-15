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
            'startdate' => date('Y-m-d',strtotime('12/01/2019')),
            'closedate' => date('Y-m-d',strtotime('07/01/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('01/05/2020')),
            'closedate' => null,
            'status' => 'Por Pagar',
            'amount' => 1,
            'paymentmethod_id' => 1
        ]);

        //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('08/01/2020')),
            'closedate' => date('Y-m-d',strtotime('08/01/2020')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('09/02/2020')),
            'closedate' => date('Y-m-d',strtotime('09/02/2020')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('10/03/2020')),
            'closedate' => date('Y-m-d',strtotime('10/03/2020')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/01/2020')),
            'closedate' => date('Y-m-d',strtotime('11/01/2020')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/01/2020')),
            'closedate' => date('Y-m-d',strtotime('12/01/2020')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('01/01/2020')),
            'closedate' => null,
            'status' => 'Por Pagar',
            'amount' => 1,
            'paymentmethod_id' => 3
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('09/10/2019')),
            'closedate' => date('Y-m-d',strtotime('09/10/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 4
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('10/10/2019')),
            'closedate' => null,
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 4
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/10/2019')),
            'closedate' => date('Y-m-d',strtotime('11/10/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 4
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/10/2019')),
            'closedate' => date('Y-m-d',strtotime('12/11/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 4
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('01/10/2019')),
            'closedate' => null,
            'status' => 'Por Pagar',
            'amount' => 1,
            'paymentmethod_id' => 4
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('11/15/2019')),
            'closedate' => date('Y-m-d',strtotime('11/15/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 5
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('12/15/2019')),
            'closedate' => date('Y-m-d',strtotime('12/15/2019')),
            'status' => 'Pagado',
            'amount' => 1,
            'paymentmethod_id' => 5
        ]);

        DB::table('payment_account_statements')->insert([
            'startdate' => date('Y-m-d',strtotime('01/15/2020')),
            'closedate' => null,
            'status' => 'Por Pagar',
            'amount' => 1,
            'paymentmethod_id' => 5
        ]);

    }
}
