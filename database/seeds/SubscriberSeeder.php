<?php

use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscribers')->insert([
            'name' => 'Adira',
            'lastname' => 'Quintero',
            'birthday' => date('Y-m-d',strtotime('11/04/2019')),
            'phone' => '0424-2748070',
            'created_at' => date('Y-m-d',strtotime('15/09/2019')),
            'updated_at' => date('Y-m-d',strtotime('15/09/2019')),
            'user_id' => 1
        ]);

        DB::table('subscribers')->insert([
            'name' => 'Kimberlyn',
            'lastname' => 'Iriarte',
            'birthday' => date('Y-m-d',strtotime('11/04/2019')),
            'phone' => '0424-7772240',
            'created_at' => date('Y-m-d',strtotime('03/09/2019')),
            'updated_at' => date('Y-m-d',strtotime('03/09/2019')),
            'user_id' => 2
        ]);

        DB::table('subscribers')->insert([
            'name' => 'Juan',
            'lastname' => 'Landaeta',
            'birthday' => date('Y-m-d',strtotime('11/04/2019')),
            'phone' => '0424-259896',
            'created_at' => date('Y-m-d',strtotime('10/09/2019')),
            'updated_at' => date('Y-m-d',strtotime('10/09/2019')),
            'user_id' => 3
        ]);

        DB::table('subscribers')->insert([
            'name' => 'Grabiel',
            'lastname' => 'Landaeta',
            'birthday' => date('Y-m-d',strtotime('11/04/2019')),
            'phone' => '0424-2528077',
            'created_at' => date('Y-m-d',strtotime('02/09/2019')),
            'updated_at' => date('Y-m-d',strtotime('02/09/2019')),
            'user_id' => 4
        ]);

        DB::table('subscribers')->insert([
            'name' => 'Grabiela',
            'lastname' => 'Hernandez',
            'birthday' => date('Y-m-d',strtotime('11/04/2019')),
            'phone' => '0424-2745896',
            'created_at' => date('Y-m-d',strtotime('10/09/2019')),
            'updated_at' => date('Y-m-d',strtotime('10/09/2019')),
            'user_id' => 5
        ]);


    }
}
