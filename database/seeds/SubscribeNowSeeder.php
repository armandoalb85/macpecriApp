<?php

use Illuminate\Database\Seeder;

class SubscribeNowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscribe_nows')->insert([
            'name' => 'Mensaje de prueba',
            'description' => 'Esto es un mensaje de prueba para suscripción en susibete ahora.',
            'status' => 'Activo',
            'pathimage' => null
        ]);
    }
}
