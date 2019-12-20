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
          'startdate' => date('Y-m-d',strtotime('13/10/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 1,
          'paymentmethod_id' => 1
      ]);

      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('09/12/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 2,
          'paymentmethod_id' => 1
      ]);

      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('03/09/2018')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 3,
          'paymentmethod_id' => 1
      ]);

      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('02/10/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 4,
          'paymentmethod_id' => 1
      ]);

      DB::table('payment_method_records')->insert([
          'startdate' => date('Y-m-d',strtotime('06/10/2019')),
          'closedate' => null,
          'status' => 'Activo',
          'subscriber_id' => 5,
          'paymentmethod_id' => 1
      ]);
    }
}
