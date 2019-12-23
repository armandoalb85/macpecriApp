<?php

use Illuminate\Database\Seeder;

class AfiliationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('newsletter_subscriber')->insert([
            'startdate' => date('Y-m-d',strtotime('06/10/2019')),
            'closedate' => null,
            'status' => 'Activa',
            'subscriber_id' => 1,
            'newsletter_id' => 1
        ]);

        DB::table('newsletter_subscriber')->insert([
            'startdate' => date('Y-m-d',strtotime('09/12/2019')),
            'closedate' => null,
            'status' => 'Activa',
            'subscriber_id' => 2,
            'newsletter_id' => 2
        ]);

        DB::table('newsletter_subscriber')->insert([
            'startdate' => date('Y-m-d',strtotime('03/09/2018')),
            'closedate' => null,
            'status' => 'Activa',
            'subscriber_id' => 3,
            'newsletter_id' => 1
        ]);

        DB::table('newsletter_subscriber')->insert([
            'startdate' => date('Y-m-d',strtotime('02/10/2019')),
            'closedate' => null,
            'status' => 'Activa',
            'subscriber_id' => 4,
            'newsletter_id' => 2
        ]);

        DB::table('newsletter_subscriber')->insert([
            'startdate' => date('Y-m-d',strtotime('06/10/2019')),
            'closedate' => null,
            'status' => 'Activa',
            'subscriber_id' => 5,
            'newsletter_id' => 1
        ]);
    }
}
