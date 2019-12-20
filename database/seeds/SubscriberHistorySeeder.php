<?php

use Illuminate\Database\Seeder;

class SubscriberHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('subscriber_histories')->insert([
          'status' => 'Cancelado',
          'activedate' => date('Y-m-d',strtotime('11/04/2017')),
          'closedate' => date('Y-m-d',strtotime('11/04/2018')),
          'subscriber_id' => 1
      ]);

      DB::table('subscriber_histories')->insert([
          'status' => 'Cancelado',
          'activedate' => date('Y-m-d',strtotime('11/04/2018')),
          'closedate' => date('Y-m-d',strtotime('11/01/2019')),
          'subscriber_id' => 1
      ]);

      DB::table('subscriber_histories')->insert([
          'status' => 'Activo',
          'activedate' => date('Y-m-d',strtotime('13/10/2019')),
          'closedate' => null,
          'subscriber_id' => 1
      ]);

      DB::table('subscriber_histories')->insert([
          'status' => 'Activo',
          'activedate' => date('Y-m-d',strtotime('09/12/2019')),
          'closedate' => null,
          'subscriber_id' => 2
      ]);

      DB::table('subscriber_histories')->insert([
          'status' => 'Activo',
          'activedate' => date('Y-m-d',strtotime('03/09/2018')),
          'closedate' => null,
          'subscriber_id' => 3
      ]);

      DB::table('subscriber_histories')->insert([
          'status' => 'Activo',
          'activedate' => date('Y-m-d',strtotime('02/10/2019')),
          'closedate' => null,
          'subscriber_id' => 4
      ]);

      DB::table('subscriber_histories')->insert([
          'status' => 'Activo',
          'activedate' => date('Y-m-d',strtotime('06/10/2019')),
          'closedate' => null,
          'subscriber_id' => 5
      ]);

    }
}
