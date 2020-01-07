<?php

use Illuminate\Database\Seeder;

class SubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscription_types')->insert([
            'name' => 'Subscripcion Gratuita',
            'description' => 'Subscripcion con lectura de articulos limitados.',
            'cost' => 0,
            'limit' => 10,
            'status' => 'Activo',
            'daysforpaying' => 0,
            'type' => 'Gratuita'
        ]);

        DB::table('subscription_types')->insert([
            'name' => 'Subscripcion Paga',
            'description' => 'Subscripcion con lectura ilimitada.',
            'cost' => 1,
            'limit' => 999999,
            'status' => 'Activo',
            'daysforpaying' => 5,
            'type' => 'Pago'
        ]);

        DB::table('subscription_types')->insert([
            'name' => 'Venezuela',
            'description' => 'Subscripcion ilimitada usuarios de Venezuela',
            'cost' => 0,
            'limit' => 999999,
            'status' => 'Activo',
            'daysforpaying' => 0,
            'type' => 'Venezuela'
        ]);
    }
}
