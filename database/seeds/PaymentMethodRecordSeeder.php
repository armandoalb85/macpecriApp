<?php

use Illuminate\Database\Seeder;

class PaymentMethodRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('10/11/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 5,
          'paymentmethod_id' => 1
      ]);

      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('11/15/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 4,
          'paymentmethod_id' => 1
      ]);
      //¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨¨
      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('08/01/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 6,
          'paymentmethod_id' => 1
      ]);

      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('09/10/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 7,
          'paymentmethod_id' => 1
      ]);

      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('11/15/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 8,
          'paymentmethod_id' => 1
      ]);

    }
}
