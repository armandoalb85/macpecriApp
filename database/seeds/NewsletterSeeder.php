<?php

use Illuminate\Database\Seeder;

class NewsletterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('newsletters')->insert([
            'name' => 'Boletin A',
            'description' => 'Esto es un boletin de prueba',
            'stardate' => date('Y-m-d',strtotime('12/20/2019')),
            'closedate' => null
        ]);

        DB::table('newsletters')->insert([
            'name' => 'Boletin B',
            'description' => 'Esto es un boletin de prueba',
            'stardate' => date('Y-m-d',strtotime('12/20/2019')),
            'closedate' => null
        ]);

        DB::table('newsletters')->insert([
            'name' => 'Boletin B',
            'description' => 'Esto es un boletin de prueba',
            'stardate' => date('Y-m-d',strtotime('12/20/2019')),
            'closedate' => null
        ]);
    }
}
