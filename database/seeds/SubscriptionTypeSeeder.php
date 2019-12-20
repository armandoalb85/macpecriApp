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
            'name' => 'Subscripción Gratuita',
            'description' => 'Subscripcion con lectura de articulos limitados.',
            'cost' => 0,
            'limit' => 10,
            'status' => 'Activo'
        ]);

        DB::table('subscription_types')->insert([
            'name' => 'Subscripción Paga',
            'description' => 'Subscripcion con lectura ilimitada.',
            'cost' => 1,
            'limit' => 999999,
            'status' => 'Activo'
        ]);
    }
}
