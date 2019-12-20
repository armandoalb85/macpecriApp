<?php

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('payment_methods')->insert([
          'name' => 'Paypal',
          'status' => 'Activo',
          'description' => 'Metodo de pago en linea'
      ]);

      DB::table('payment_methods')->insert([
          'name' => 'Credito',
          'status' => 'Inactivo',
          'description' => 'Metodo de pago Master Card'
      ]);
    }
}
