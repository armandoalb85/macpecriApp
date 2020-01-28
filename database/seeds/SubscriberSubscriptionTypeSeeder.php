<?php

use Illuminate\Database\Seeder;

class SubscriberSubscriptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('10/15/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('09/15/2019')),
            'updated_at' => date('Y-m-d',strtotime('09/15/2019')),
            'subscriber_id' => 1,
            'subscription_id' => 1,
            'status' => 'Activo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('09/03/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('09/03/2019')),
            'updated_at' => date('Y-m-d',strtotime('09/03/2019')),
            'subscriber_id' => 2,
            'subscription_id' => 1,
            'status' => 'Activo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('09/10/2018')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('09/10/2019')),
            'updated_at' => date('Y-m-d',strtotime('09/10/2019')),
            'subscriber_id' => 3,
            'subscription_id' => 3,
            'status' => 'Activo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('09/02/2019')),
            'closedate' => date('Y-m-d',strtotime('11/15/2019')),
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('09/02/2019')),
            'updated_at' => date('Y-m-d',strtotime('11/15/2019')),
            'subscriber_id' => 4,
            'subscription_id' => 1,
            'status' => 'Inactivo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('09/10/2019')),
            'closedate' => date('Y-m-d',strtotime('10/11/2019')),
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('09/10/2019')),
            'updated_at' => date('Y-m-d',strtotime('09/10/2019')),
            'subscriber_id' => 5,
            'subscription_id' => 1,
            'status' => 'Inactivo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('11/15/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('11/15/2019')),
            'updated_at' => date('Y-m-d',strtotime('11/15/2019')),
            'subscriber_id' => 4,
            'subscription_id' => 2,
            'status' => 'Activo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('10/11/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('09/10/2019')),
            'updated_at' => date('Y-m-d',strtotime('10/11/2019')),
            'subscriber_id' => 5,
            'subscription_id' => 2,
            'status' => 'Activo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('08/01/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('08/01/2019')),
            'updated_at' => date('Y-m-d',strtotime('08/01/2019')),
            'subscriber_id' => 6,
            'subscription_id' => 2,
            'status' => 'Activo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('09/10/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('09/10/2019')),
            'updated_at' => date('Y-m-d',strtotime('09/10/2019')),
            'subscriber_id' => 7,
            'subscription_id' => 2,
            'status' => 'Activo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('09/15/2019')),
            'closedate' => date('Y-m-d',strtotime('11/15/2019')),
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('09/15/2019')),
            'updated_at' => date('Y-m-d',strtotime('09/15/2019')),
            'subscriber_id' => 8,
            'subscription_id' => 1,
            'status' => 'Inactivo'
        ]);

        DB::table('subscriber_subscription_type')->insert([
            'startdate' => date('Y-m-d',strtotime('11/15/2019')),
            'closedate' => null,
            'status' => 0,
            'limit' => 10,
            'created_at' => date('Y-m-d',strtotime('11/15/2019')),
            'updated_at' => date('Y-m-d',strtotime('11/15/2019')),
            'subscriber_id' => 8,
            'subscription_id' => 2,
            'status' => 'Activo'
        ]);
    }
}
