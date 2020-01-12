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
            'name' => 'Pantalla Inicial',
            'description' => 'Esto es un mensaje de prueba para suscripción, Pantalla Inicial.',
            'status' => 'Activo',
            'category' => 'Principal',
            'pathimage' => null
        ]);

        DB::table('subscribe_nows')->insert([
            'name' => '¿Por qué Macpecri?',
            'description' => 'Esto es un mensaje de prueba para suscripción, ¿Por qué Macpecri?.',
            'status' => 'Activo',
            'category' => 'Aducir',
            'pathimage' => null
        ]);

        DB::table('subscribe_nows')->insert([
            'name' => '¿Qué Obtienes?',
            'description' => 'Esto es un mensaje de prueba para suscripción, ¿Qué Obtienes?.',
            'status' => 'Activo',
            'category' => 'Beneficio',
            'pathimage' => null
        ]);

        DB::table('subscribe_nows')->insert([
            'name' => 'Cuenta de Pago',
            'description' => 'Esto es un mensaje de prueba para suscripción, Precio.',
            'status' => 'Activo',
            'category' => 'Precio',
            'pathimage' => null
        ]);

        DB::table('subscribe_nows')->insert([
            'name' => 'Cuenta Gratuita',
            'description' => 'Esto es un mensaje de prueba para suscripción, Precio.',
            'status' => 'Activo',
            'category' => 'Precio',
            'pathimage' => null
        ]);

        DB::table('subscribe_nows')->insert([
            'name' => 'Más',
            'description' => 'Esto es un mensaje de prueba para suscripción, Más.',
            'status' => 'Activo',
            'category' => 'Mas',
            'pathimage' => null
        ]);

    }
}
